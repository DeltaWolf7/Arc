<?php

/*
 * The MIT License
 *
 * Copyright 2014 Craig Longford.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Basic object data provider
 *
 * @author Craig Longford
 */
abstract class DataProvider {

    public $id;
    public $table;
    public $columns;

    public function __construct() {
        $this->id = 0;
        $this->table = "";
        $this->columns = array();
    }

    public function get($where) {
        $data = $GLOBALS["arc"]->getDatabase()->get($this->table, $this->columns, $where);
        $this->fill($data);
    }

    public function getByID($id) {
        return $this->get(["id" => $id]);
    }

    public function getCollection($where) {
        $data = $GLOBALS["arc"]->getDatabase()->select($this->table, $this->columns, $where);
        $collection = array();
        if (is_array($data)) {
            foreach ($data as $item) {
                $className = get_class($this);
                $newObject = new $className;
                $newObject->fill($item);
                $collection[] = $newObject;
            }
        }
        return $collection;
    }

    public function update() {
        $columns = array_slice($this->columns, 1);
        $dataColumns = array();
        $properties = get_object_vars($this);
        foreach ($columns as $column) {
            if ($column != "table" && $column != "columns") {
                $dataColumns[$column] = $properties[$column];
            }
        }
        if ($this->id == 0) {
            $this->id = $GLOBALS["arc"]->getDatabase()->insert($this->table, $dataColumns);
        } else {
            $GLOBALS["arc"]->getDatabase()->update($this->table, $dataColumns, ["id" => $this->id]);
        }
    }

    public function delete($id) {
        $GLOBALS["arc"]->getDatabase()->delete($this->table, ["id" => $id]);
    }

    protected function fill($data) {
        if (is_array($data)) {
            foreach ($data as $property => $value) {
                $this->$property = $value;
            }
        }
    }

}
