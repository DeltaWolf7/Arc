<?php

/*
 * The MIT License
 *
 * Copyright 2014 craig.
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
     * Description of usergroups
     *
     * @author craig
     */
    class UserGroup extends DataProvider {

        public $name;
        public $description;

        /**
         * UserGroup constructor
         */
        public function __construct() {
            parent::__construct();
            $this->name = "";
            $this->description = "";
            $this->table = ARCDBPREFIX . "user_groups";
            $this->columns = ["id", "name", "description"];
        }

        /**
         * 
         * @param string $name Name of the group
         * @return \UserGroup
         */
        public static function getByName($name) {
            $group = new UserGroup();
            $group->get(["name" => $name]);
            return $group;
        }

        /**
         * 
         * @return UserPermission Permission of the user of a group
         */
        public function getPermissions() {
            return UserPermission::getByGroupID($this->id);
        }

        /**
         * 
         * @return UserGroup Returns all groups
         */
        public static function getAllGroups() {
            $groups = new UserGroup();
            return $groups->getCollection(["ORDER" => "name ASC"]);
        }
        
        public function getUsers() {
            $users = new User();
            return $users->getCollection(["usergroupid" => $this->id]);
        }

    }

