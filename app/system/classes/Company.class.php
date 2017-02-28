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
        $this->name = "";
        $this->table = ARCDBPREFIX . "companies";
        $this->map = ["id" => "id", "name" => "name"];
        $this->columns = ["id", "name"];
    }

    /**
     * Get Company object by Name
     * @param type $name
     * @return \Company
     */
    public static function getByName($name) {
        $company = new Company();
        $company->get(["name" => $name]);
        return $company;
    }

    /**
     * Get Company by ID
     * @param type $id
     * @return \Company
     */
    public static function getByID($id) {
        $company = new Company();
        $company->get(["id" => $id]);
        return $company;
    }

    /**
     * Get Users associated with the Company
     * @return type
     */
    public function getUsers() {
        $users = User::getAllUsers();
        $found = [];
        foreach ($users as $user) {
            $companies = $user->getCompanies();
            foreach ($companies as $company) {
                if ($company->id == $this->id) {
                    $found[] = $user;
                }
            }
        }
        return $found;
    }

    /**
     * Get all Companies
     * @return type
     */
    public static function getAll() {
        $company = new Company();
        return $company->getCollection(["ORDER" => ['name' => 'ASC']]);
    }

}