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
 * User Permission object
 */
class UserPermission extends DataProvider {

    // Associated Group ID
    public $groupid;
    // Permissions
    public $permission;

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        $this->groupid = 0;
        $this->permission = "";
        $this->table = ARCDBPREFIX . 'user_permissions';
        $this->map = ["id" => "id", "groupid" => "groupid", "permission" => "permission"];
        $this->columns = ['id', 'groupid', 'permission'];
    }

    /**
     * Check Group has permission to entity
     * @param type $groups
     * @param type $entry
     * @return boolean
     */
    public static function hasPermission($groups, $entry) {
        if (is_array($groups)) {
            foreach ($groups as $group) {
                foreach ($group->getPermissions() as $permission) {
                    if ($permission->permission == $entry) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Get Permissions by Group ID
     * @param type $groupid
     * @return type
     */
    public static function getByGroupID($groupid) {
        $permission = new UserPermission();
        return $permission->getCollection(['groupid' => $groupid]);
    }

    /**
     * Get associated Group
     * @return type
     */
    public function getGroup() {
        $group = UserGroup::getByID($this->groupid);
        return $group;
    }
    
    /**
     * Get Permission by unique identifier
     * @param type $id
     * @return \UserPermission
     */
    public static function getByID($id) {
        $permission = new UserPermission();
        $permission->get(['id' => $id]);
        return $permission;
    }
}
