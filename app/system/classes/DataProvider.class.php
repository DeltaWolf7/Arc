<?php

/* 
 * The MIT License
 *
 * Copyright 2017 Craig Longford (deltawolf7@gmail.com).
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
    public $map;

    /**
     * DataProvider constructor
     */
    public function __construct() {
        $this->id = 0;
        $this->table = '';
        $this->columns = [];
        $this->map = [];
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

    public function getCount($where) {
        $count = system\Helper::arcGetDatabase()->count($this->table, $where);
        return $count;
    }

    /**
     * Updates the data of an object in the database
     */
    public function update() {
        $dataColumns = [];
        $properties = get_object_vars($this);
        foreach ($this->map as $property => $column) {
            $dataColumns[$column] = $properties[$property];
        }
        if ($this->id == 0) {
            system\Helper::arcGetDatabase()->insert($this->table, $dataColumns);
            $this->id = system\Helper::arcGetDatabase()->id();
        } else {
            system\Helper::arcGetDatabase()->update($this->table, $dataColumns, ['id' => $this->id]);
        }
    }

    /**
     * 
     * @param int $id Removes a database row based on the ID
     */
    public function delete($id) {
        system\Helper::arcGetDatabase()->delete($this->table, ['id' => $id]);
    }

    /**
     * 
     * @param array $data Data to fill the object with
     * Matches properties to columns to fill
     */
    protected function fill($data) {
        if (is_array($data)) {
            foreach ($this->map as $property => $column) {
                if (isset($data[$column])) {
                    $this->$property = $data[$column];
                }
            }
        }
    }

}
