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
     * Description of userpermissions
     *
     * @author craig
     */
    class UserPermission extends DataProvider {

        public $groupid;
        public $permission;

        /**
         * UserPermission constructor
         */
        public function __construct() {
            parent::__construct();
            $this->groupid = 0;
            $this->permission = "";
            $this->table = ARCDBPREFIX . "user_permissions";
            $this->columns = ["id", "groupid", "permission"];
        }

        /**
         * 
         * @param \UserPermission $permissions Permission collection
         * @param string $entry Permission to check for
         * @return boolean True if authorised
         */
        public static function hasPermission($permissions, $entry) {
            foreach ($permissions as $permission) {
                if ($permission->permission == $entry) {
                    return true;
                }
            }
            return false;
        }

        /**
         * 
         * @param int $groupid Group ID
         * @return \UserPermission
         */
        public static function getByGroupID($groupid) {
            $permission = new UserPermission();
            return $permission->getCollection(["groupid" => $groupid]);
        }

        /**
         * 
         * @return \UserGroup Gets user's group
         */
        public function getGroup() {
            $group = new UserGroup();
            $group->getByID($this->groupid);
            return $group;
        }

    }
