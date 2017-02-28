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
 * User object
 */
class User extends DataProvider {

    // Firstname
    public $firstname;
    // Lastname
    public $lastname;
    // Email address
    public $email;
    // Password hash (consider making protected)
    public $passwordhash;
    // Date/Time the user was created
    public $created;
    // User account enabled?
    public $enabled;
    // User associated groups
    public $groups;
    // user associated company
    public $company;

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        $this->firstname = "";
        $this->lastname = "";
        $this->email = "";
        $this->enabled = true;
        $this->passwordhash = "";
        $this->groups = "[\"Users\"]";
        $this->company = "[]";
        $this->created = date("y-m-d H:i:s");
        $this->table = ARCDBPREFIX . "users";
        $this->map = ["id" => "id", "firstname" => "firstname", "lastname" => "lastname",
            "email" => "email", "passwordhash" => "passwordhash", "created" => "created",
            "enabled" => "enabled", "groups" => "groups", "company" => "company"];
        $this->columns = ["id", "firstname", "lastname", "email", "passwordhash", "created",
            "enabled", "groups", "company"];
    }

    /**
     * Get User by email address
     * @param type $email
     * @return \User
     */
    public static function getByEmail($email) {
        $user = new User();
        $user->get(["email" => $email]);
        return $user;
    }
    
    /**
     * Get User by unique identifier
     * @param type $id
     * @return \User
     */
    public static function getByID($id) {
        $user = new User();
        $user->get(["id" => $id]);
        return $user;
    }

    /**
     * get all users from the database
     * @return type
     */
    public static function getAllUsers() {
        $user = new User();
        return $user->getCollection(["ORDER" => ['firstname' => 'ASC']]);
    }

    /**
     * Check is user is in a group
     * @param type $name
     * @return boolean
     */
    public function inGroup($name) {
        $groups = $this->getGroups();
        foreach ($groups as $group) {
            if ($group->name == $name) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get groups the User is associated with
     * @return type
     */
    public function getGroups() {
        $groups = [];
        foreach (json_decode($this->groups) as $group) {
            $grp = UserGroup::getByName($group);
            if ($grp->id != 0) {
                $groups[] = $grp;
            }
        }
        return $groups;
    }

    /**
     * Add User to a group
     * @param type $name
     * @return type
     */
    public function addToGroup($name) {
        $groups = json_decode($this->groups);
        foreach ($groups as $group) {
            if ($group == $name) {
                return;
            }
        }
        $groups[] = $name;
        $this->groups = json_encode($groups);
        $this->update();
    }

    /**
     * Remove the user from a group
     * @param type $name
     */
    public function removeFromGroup($name) {
        $groups = json_decode($this->groups);
        $newGroups = [];
        for ($i = 0; $i < count($groups); $i++) {
            if ($groups[$i] != $name) {
                $newGroups[] = $groups[$i];
            }
        }
        $this->groups = json_encode($newGroups);
        $this->update();
    }

    /**
     * Set the Users password
     * @param type $password
     */
    public function setPassword($password) {
        $this->passwordhash = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Check the users password is correct
     * @param type $password
     * @return type
     */
    public function verifyPassword($password) {
        return password_verify($password, $this->passwordhash);
    }

    /**
     * Get a users setting by its unique key
     * @param type $key
     * @return type
     */
    public function getSettingByKey($key) {
        return UserSetting::getByUserID($this->id, $key);
    }

    /**
     * Get the users full name formatted
     * @return type
     */
    public function getFullname() {
        return $this->firstname . " " . $this->lastname;
    }
    
    /**
     * Get the companies associated with the user
     * @return type
     */
    public function getCompanies() {
        $companies = json_decode($this->company);
        $comp = [];
        foreach ($companies as $company) {
            $comp[] = Company::getByID($company);
        }
        return $comp;
    }
    
    /**
     * Add User to Company
     * @param type $id
     * @return type
     */
    public function addToCompany($id) {
        $companies = json_decode($this->company);
        foreach ($companies as $company) {
            if ($company == $id) {
                return;
            }
        }
        $companies[] = $id;
        $this->company = json_encode($companies);
        $this->update();
    }

    /**
     * Remove User from a Company
     * @param type $id
     */
    public function removeFromCompany($id) {
        $companies = json_decode($this->company);
        $newComps = [];
        for ($i = 0; $i < count($companies); $i++) {
            if ($companies[$i] != $id) {
                $newComps[] = $companies[$i];
            }
        }
        $this->company = json_encode($newComps);
        $this->update();
    }
}
