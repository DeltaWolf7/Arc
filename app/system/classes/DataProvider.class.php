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

    // Unique Identifier
    public $id;
    // Database table
    public $table;
    // Database table columns to properties map
    public $map;

    /**
     * Default constructor
     */
    public function __construct() {
        // Initilise ID
        $this->id = 0;
        // Initilise table name
        $this->table = '';
        // Initilise map
        $this->map = [];
    }

    /**
     * Get the columns from the map of the object
     * @return array Columns array
     */
    protected function getColumns() {
        // Create array to hold columns
        $columns = [];
        // Go through each item in the object map
        foreach ($this->map as $property => $column) {
            // Add the column to the array
            $columns[] = $column;
        }
        // Return the array
        return $columns;
    }

    /**
     * Get data from database and fill the object
     * @param string $where Query to execute against the database
     */
    public function get($where) {
        // Run query against the database
        $data = system\Helper::arcGetDatabase()->get($this->table, $this->getColumns(), $where);
        // Fill the object
        $this->fill($data);
    }

    /**
     * Get a collection of objects filled from the database
     * @param string $where Query to execute against the database
     * @return array Collection of objects
     */
    public function getCollection($where) {
        // Run query against the database
        $data = system\Helper::arcGetDatabase()->select($this->table, $this->getColumns(), $where);
        // Create array to hold the objects
        $collection = array();
        // Check we have an array from the database
        if (is_array($data)) {
            // Go through each item in the array
            foreach ($data as $item) {
                // Get the class needed to create the object
                $className = get_class($this);
                // Create a new object from its class
                $newObject = new $className;
                // Fill the new object
                $newObject->fill($item);
                // Add the object to the collection
                $collection[] = $newObject;
            }
        }
        // Return the collection
        return $collection;
    }

    /**
     * Count the number of objects returned by query
     * @param string $where Query to execute against the database
     * @return int Number of rows matching query
     */
    public function getCount($where) {
        // Execute query against database
        $count = system\Helper::arcGetDatabase()->count($this->table, $where);
        // Return number of rows
        return $count;
    }

    /**
     * Update/create the data from object in database using mapped fields
     */
    public function update() {
        // Create array to hold column to property data
        $dataColumns = [];
        // Get the properties of the object
        $properties = get_object_vars($this);
        // Go through each item in the map
        foreach ($this->map as $property => $column) {
            // Add the column to the array and set the value
            $dataColumns[$column] = $properties[$property];
        }
    
        try {
            // Is this a new object or something already in the database?
            if ($this->id == 0) {
                // This is a new object, so we insert it
                system\Helper::arcGetDatabase()->insert($this->table, $dataColumns);
                // Set the ID of the object
                $this->id = system\Helper::arcGetDatabase()->id();
            } else {
                // This is a old object, we just need to update it
                system\Helper::arcGetDatabase()->update($this->table, $dataColumns, ['id' => $this->id]);
            }
        } catch (PDOException $ex) {
            // Something has gone wrong, kill the application and report it
            die("Error:<br />" . $ex->getMessage() . "<br /><br />Trace:<br />" . $ex->getTraceAsString()
                    . "<br /><br />Last query:<br />" . system\Helper::arcGetDatabase()->last());
        }
    }

    /**
     * Delete an object from the database
     * @param int $id ID of the object to remove from database
     */
    public function delete($id) {
        // Execute query against database
        system\Helper::arcGetDatabase()->delete($this->table, ['id' => $id]);
    }

    /**
     * Fill and object with data from database using mapped fields
     * @param array $data Database data
     */
    protected function fill($data) {
        // Check we have a valid array
        if (is_array($data)) {
            // Go through each map item
            foreach ($this->map as $property => $column) {
                // Remove any datatype declaration from column map
                $actualColumn = preg_replace("/ \[.+?\]/", "", $column);
                // Check we have data for the column
                if (isset($data[$actualColumn])) {
                    // Populate object property with matching column data
                    $this->$property = $data[$actualColumn];
                }
            }
        }
    }
}