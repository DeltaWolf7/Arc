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

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        // Initilise firstname
        $this->firstname = "";
        // Initilise lastname
        $this->lastname = "";
        // Initilise email
        $this->email = "";
        // Initilise account enabled
        $this->enabled = false;
        // Initilise password hash
        $this->passwordhash = "";
        // Initilise groups array
        $this->groups = ["Users"];
        // Initilise created date to now
        $this->created = date("y-m-d H:i:s");
        // Set the table used by this object
        $this->table = ARCDBPREFIX . "users";
        // Set the property to column mapping
        $this->map = ["id" => "id", "firstname" => "firstname", "lastname" => "lastname",
            "email" => "email", "passwordhash" => "passwordhash", "created" => "created",
            "enabled" => "enabled", "groups" => "groups [JSON]"];
    }

    /**
     * Get User by email address
     * @param string $email Email address of the user
     * @return \User User object
     */
    public static function getByEmail($email) {
        // Create a new user object
        $user = new User();
        // Get the user data from database by email address
        $user->get(["email" => $email]);
        // Return the user object
        return $user;
    }
    
    /**
     * Get User by unique identifier
     * @param int $id Unique ID for the user
     * @return \User User object
     */
    public static function getByID($id) {
        // Create a new user object
        $user = new User();
        // Get the data from the database for the user by ID
        $user->get(["id" => $id]);
        // return the user object
        return $user;
    }

    /**
     * Get all users from the database
     * @return array Collection of user objects
     */
    public static function getAllUsers() {
        // Create a User object
        $user = new User();
        // Return an array of user objects from the database, ordered by firstname
        return $user->getCollection(["ORDER" => ['firstname' => 'ASC']]);
    }

    /**
     * Check is user is in a group
     * @param string $name Group name
     * @return boolean If the user belongs to the group or not
     */
    public function inGroup($name) {
        // Check if the user belongs to the group
        if (in_array($name, $this->groups)) {
            // If then do, return true
            return true;
        }
        // User doesn't belong to group, return false
        return false;
    }

    /**
     * Get groups the User is associated with
     * @return array Collection of groups
     */
    public function getGroups() {
        // Array to hold the group objects
        $groups = [];
        // Loop through each of the groups the user belongs to
        foreach ($this->groups as $group) {
            // Get the group from the database
            $grp = UserGroup::getByName($group);
            // If the group has a valid ID (not 0 or less)
            if ($grp->id != 0) {
                // Add the group to the array
                $groups[] = $grp;
            }
        }
        // Return the groups array
        return $groups;
    }

    /**
     * Add User to a group
     * @param string $name Group name to ass the user too
     */
    public function addToGroup($name) {
        // Check if the user belongs to the group
        if (!in_array($name, $this->groups)) {
            // If not, then we add them to the group
            $this->groups[] = $name;
            // Update the object in the database
            $this->update();
        }
    }

    /**
     * Remove the user from a group
     * @param string $name Group name to remove the user from
     */
    public function removeFromGroup($name) {
        // Check is the user belongs to the group
        if (($key = array_search($name, $this->groups)) !== false) {
            // If they do, then we remove them
            unset($this->groups[$key]);
            // Update the object in the database
            $this->update();
        }
    }

    /**
     * Set the password hash of the user
     * @param string $password Plain text password to be hashed
     */
    public function setPassword($password) {
        // Hash the password and set it on the user object
        $this->passwordhash = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Check the users password is correct
     * @param string $password The users password
     * @return bool true if the password is correct and false if not
     */
    public function verifyPassword($password) {
        // Check the users password is correct
        return password_verify($password, $this->passwordhash);
    }

    /**
     * Get a setting of the user by its key
     * @param string $key The unique key for the setting
     * @return object UserSetting object
     */
    public function getSettingByKey($key) {
        // Return the user setting found by the key
        return UserSetting::getByUserID($this->id, $key);
    }

    /**
     * Get the full name of the user
     * @return string Users name formatted as "{firstname} {lastname}"
     */
    public function getFullname() {
        // Return the formatted name of the user
        return "{$this->firstname} {$this->lastname}";
    }

    /**
     * Return the profile image of the user or placeholder if none.
     * @return string profile path
     */
    public function getProfileImage() {
        $profileImage = SystemSetting::getByKey("ARC_USER_IMAGE", $this->id);
        if (!empty($profileImage->value)) {
           return system\Helper::arcGetPath() . "assets/profile/" . $profileImage->value;
        }
        return system\Helper::arcGetPath() . "assets/profile/placeholder.png";
    }
}
