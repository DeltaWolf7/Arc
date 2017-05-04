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
class Router extends DataProvider
{

    // route
    public $route;
    // destination
    public $destination;
    // group allowed
    public $groupallowed;
    // visible
    public $visible;

    /**
     * Default constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->route = "";
        $this->destination = "";
        $this->groupallowed = 0;
        $this->visible = true;
        $this->table = ARCDBPREFIX . 'router';
        $this->map = ["id" => "id", "route" => "route", "destination" => "destination",
            "groupallowed" => "groupallowed", "visible" => "visible"];
        $this->columns = ['id', 'route', 'destination', 'groupallowed', 'visible'];
    }

    /**
     * Check Group has permission to entity
     * @param type $groups
     * @param type $entry
     * @return boolean
     */
    public static function hasPermission($groups, $route)
    {
        if (is_array($groups)) {
            foreach ($groups as $group) {
                foreach ($group->getPermissions() as $permission) {
                    if ($permission->route == $route) {
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
    public static function getByGroupID($groupallowed, $visibleOnly = true)
    {
        $router = new Router();
        if ($visibleOnly == true) {
            return $router->getCollection(['groupallowed' => $groupallowed, "visible" => true]);
        }
        return $router->getCollection(['groupallowed' => $groupallowed]);
    }

    /**
     * Get associated Group
     * @return type
     */
    public function getGroup()
    {
        $group = UserGroup::getByID($this->groupallowed);
        return $group;
    }
    
    /**
     * Get Permission by unique identifier
     * @param type $id
     * @return \UserPermission
     */
    public static function getByID($id)
    {
        $route = new Router();
        $route->get(['id' => $id]);
        return $route;
    }
    
    public static function getRoute($uri)
    {
        $route = new Router();
        $route->get(['route' => $uri]);
        if ($route->id == 0) {
            $route->get(['destination' => $uri]);
        }
        return $route;
    }


    /**
     * Return an array of currently available routes
     *
     * @param boolean $showHidden show hidden routes (system routes)
     * @return array of routes
     */
    public static function getCurrentRoutes($showHidden = false)
    {
        $routes = new Router();
        if ($showHidden) {
            return $routes->getCollection(["ORDER" => ['route' => 'ASC']]);
        } else {
            return $routes->getCollection(["ORDER" => ['route' => 'ASC'], "visible" => true]);
        }
    }
}
