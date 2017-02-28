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
 * User Group object
 */
class UserGroup extends DataProvider {

    // Group name
    public $name;
    // Group description
    public $description;

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->description = "";
        $this->table = ARCDBPREFIX . 'user_groups';
        $this->map = ["id" => "id", "name" => "name", "description" => "description"];
        $this->columns = ['id', 'name', 'description'];
    }

    /**
     * Get Group by name from database
     * @param type $name
     * @return \UserGroup
     */
    public static function getByName($name) {
        $group = new UserGroup();
        $group->get(['name' => $name]);
        return $group;
    }

    /**
     * Get Group permissions
     * @return type
     */
    public function getPermissions() {
        return UserPermission::getByGroupID($this->id);
    }

    /**
     * Get all groups
     * @return type
     */
    public static function getAllGroups() {
        $groups = new UserGroup();
        return $groups->getCollection(['ORDER' => ['name' => 'ASC']]);
    }

    /**
     * Get all users associated with Group
     * @return type
     */
    public function getUsers() {
        $users = User::getAllUsers();
        $grpUsers = Array();
        foreach ($users as $user) {
            if ($user->inGroup($this->name)) {
                $grpUsers[] = $user;
            }
        }
        return $grpUsers;
    }

    /**
     * Get Group by its unique identifier
     * @param type $id
     * @return \UserGroup
     */
    public static function getByID($id) {
        $group = new UserGroup();
        $group->get(["id" => $id]);
        return $group;
    }

    /**
     * Update/Insert Group in to database
     */
    public function update() {
        if ($this->name != "Administrators" && $this->name != "Guests" && $this->name != "Users") {
            parent::update();
        }
    }

    /**
     * Delete Group from database
     * @param type $id
     */
    public function delete($id) {
        $group = UserGroup::getByID($id);
        if ($group->name != "Administrators" && $group->name != "Guests" && $group->name != "Users") {
            parent::delete($id);
        }
    }

}