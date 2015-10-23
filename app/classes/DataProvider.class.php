<?php

/*
 * The MIT License
 *
 * Copyright 2015 Craig Longford.
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

abstract class DataProvider {

    public $id;
    public $table;
    public $columns;

    /**
     * DataProvider constructor
     */
    public function __construct() {
        $this->id = 0;
        $this->table = "";
        $this->columns = array();
    }

    /**
     * 
     * @param string $where Where array to get data
     * Fills the object once data has been collected
     */
    public function get($where) {
        $data = system\Helper::arcGetDatabase()->get($this->table, $this->columns, $where);
        $this->fill($data);
    }

    /**
     * 
     * @param int $id ID of the item to fetch from the database
     * @return object Returns the object filled with data
     */
    public function getByID($id) {
        return $this->get(["id" => $id]);
    }

    /**
     * 
     * @param array $where Array containing the claused to fetch data
     * @return object collection, filled with data
     */
    public function getCollection($where) {
        $data = system\Helper::arcGetDatabase()->select($this->table, $this->columns, $where);
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

    /**
     * Updates the data of an object in the database
     */
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
            $this->id = system\Helper::arcGetDatabase()->insert($this->table, $dataColumns);
        } else {
            system\Helper::arcGetDatabase()->update($this->table, $dataColumns, ["id" => $this->id]);
        }
    }

    /**
     * 
     * @param int $id Removes a database row based on the ID
     */
    public function delete() {
        system\Helper::arcGetDatabase()->delete($this->table, ["id" => $this->id]);
    }

    /**
     * 
     * @param array $data Data to fill the object with
     * Matches properties to columns to fill
     */
    protected function fill($data) {
        if (is_array($data)) {
            foreach ($data as $property => $value) {
                $this->$property = $value;
            }
        }
    }

}
