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

/**
 * Description of user
 *
 * @author Craig Longford
 */
class User extends DataProvider {

    public $firstname;
    public $lastname;
    public $email;
    public $passwordhash;
    public $created;
    public $enabled;
    public $groups;
    public $company;

    /**
     * User constructor
     */
    public function __construct() {
        parent::__construct();
        $this->firstname = "";
        $this->lastname = "";
        $this->email = "";
        $this->enabled = true;
        $this->passwordhash = "";
        $this->groups = "[\"Users\"]";
        $this->company = "[\"\"]";
        $this->created = date("y-m-d H:i:s");
        $this->table = ARCDBPREFIX . "users";
        $this->map = ["id" => "id", "firstname" => "firstname", "lastname" => "lastname",
            "email" => "email", "passwordhash" => "passwordhash", "created" => "created",
            "enabled" => "enabled", "groups" => "groups", "company" => "company"];
        $this->columns = ["id", "firstname", "lastname", "email", "passwordhash", "created",
            "enabled", "groups", "company"];
    }

    /**
     * 
     * @param string $email User's email address
     * @return \User
     */
    public static function getByEmail($email) {
        $user = new User();
        $user->get(["email" => $email]);
        return $user;
    }
    
    public static function getByID($id) {
        $user = new User();
        $user->get(["id" => $id]);
        return $user;
    }

    /**
     * 
     * @return \User collection (All users)
     */
    public static function getAllUsers() {
        $user = new User();
        return $user->getCollection(["ORDER" => ['firstname' => 'ASC']]);
    }

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
     * 
     * @return \UserGroup Gets the group of the user
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

    /*
     * Add user to group
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

    /*
     * Remove user from group
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
     * 
     * @param string $password Password to be set
     */
    public function setPassword($password) {
        $this->passwordhash = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * 
     * @param string $password Password to check against user
     * @return bool True if password is a match
     */
    public function verifyPassword($password) {
        return password_verify($password, $this->passwordhash);
    }

    /**
     * 
     * @param string $key Key of the setting
     * @return \UserSetting Users setting for the specified key
     */
    public function getSettingByKey($key) {
        return UserSetting::getByUserID($this->id, $key);
    }

    /*
     * Get users full name
     */

    public function getFullname() {
        return $this->firstname . " " . $this->lastname;
    }
    
    public function getCompanies() {
        $companies = json_decode($this->company);
        $comp = [];
        foreach ($companies as $company) {
            $comp[] = Company::getByID($company);
        }
        return $comp;
    }
    
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
