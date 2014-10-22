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
    public $usergroupid;

    /**
     * User constructor
     */
    public function __construct() {
        parent::__construct();
        $this->firstname;
        $this->lastname;
        $this->email = "";
        $this->enabled = true;
        $this->passwordhash = "";
        $this->usergroupid = 0;
        $this->created = date("y-m-d h:i:s");
        $this->table = ARCDBPREFIX . "users";
        $this->columns = ["id", "firstname", "lastname", "email", "passwordhash", "created", "enabled", "usergroupid"];
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

    /**
     * 
     * @return \User collection (All users)
     */
    public static function getAllUsers() {
        $user = new User();
        return $user->getCollection(["ORDER" => "firstname ASC"]);
    }
    
    /**
     * 
     * @return \UserGroup Gets the group of the user
     */
    public function getGroup() {
        $group = new UserGroup();
        $group->getByID($this->usergroupid);
        return $group;
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
     * @return \LastAccess Gets last access entry for this user
     */
    public function getLastAccess() {
        $lastaccess = new LastAccess();
        $lastaccess->getByUserID($this->id);
        return $lastaccess;
    }

    /**
     * 
     * @param string $key Key of the setting
     * @return \UserSetting Users setting for the specified key
     */
    public function getSettingByKey($key) {
         return UserSetting::getByUserID($this->id, $key);
    }
}