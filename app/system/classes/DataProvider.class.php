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

/**
 * Abstract DataProvider class
 */
abstract class DataProvider {

    // Unique Identifiyer
    public $id;
    // Database table
    public $table;
    // Database table columns
    public $columns;
    // Database table columns to properites map
    public $map;

    /**
     * Default constructor
     */
    public function __construct() {
        $this->id = 0;
        $this->table = '';
        $this->columns = [];
        $this->map = [];
    }

    /**
     * Get data from database and return filled object
     * @param type $where
     */
    public function get($where) {
        $data = system\Helper::arcGetDatabase()->get($this->table, $this->columns, $where);
        $this->fill($data);
    }

    /**
     * Get a collection of objects filled from the database
     * @param type $where
     * @return \className
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
     * Count the number of objects returned by query
     * @param type $where
     * @return type
     */
    public function getCount($where) {
        $count = system\Helper::arcGetDatabase()->count($this->table, $where);
        return $count;
    }

    /**
     * Update/Insert data from object in to database using mapped fields
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
     * Delete an object from the database
     * @param type $id
     */
    public function delete($id) {
        system\Helper::arcGetDatabase()->delete($this->table, ['id' => $id]);
    }

    /**
     * Fill and object with data from database using mapped fields
     * @param type $data
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
