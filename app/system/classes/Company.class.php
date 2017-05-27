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
 * Company object
 *
 */
class Company extends DataProvider {

    // Company name
    public $name;

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        // Initilise name
        $this->name = "";
        // Set the table used by the object
        $this->table = ARCDBPREFIX . "companies";
        // Set the property to column mapping
        $this->map = ["id" => "id", "name" => "name"];
    }

    /**
     * Get Company object by Name
     * @param string $name Name of the company
     * @return \Company company object
     */
    public static function getByName($name) {
        // Create a new company class
        $company = new Company();
        // Get the object data from the database
        $company->get(["name" => $name]);
        // Return the company object
        return $company;
    }

    /**
     * Get Company by ID
     * @param int $id Unique ID
     * @return \Company company object
     */
    public static function getByID($id) {
        // Create a new company class
        $company = new Company();
        // Get the object data from the database
        $company->get(["id" => $id]);
        // Return the company object
        return $company;
    }

    /**
     * Get Users associated with the Company
     * @return array Collection of user objects
     */
    public function getUsers() {
        // Get all users from database
        $users = User::getAllUsers();
        // Create array to hold found users
        $found = [];
        // Go through each user and check if the belong to this company
        foreach ($users as $user) {
            // Does user belong to company?
            if (in_array($this->id, $user->company)) {
                // User belongs to company, add to array
                $found[] = $user;
            }
        }
        // Return found users
        return $found;
    }

    /**
     * Get all Companies
     * @return array Collection of company objects
     */
    public static function getAll() {
        // Create new company class
        $company = new Company();
        // Return array of company objects
        return $company->getCollection(["ORDER" => ['name' => 'ASC']]);
    }

}
