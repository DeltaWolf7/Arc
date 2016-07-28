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
class Company extends DataProvider {

    public $name;
    public $users;

    /**
     * User constructor
     */
    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->users = "[\"\"]";
        $this->table = ARCDBPREFIX . "companies";
        $this->columns = ["id", "name", "users"];
    }

    public function getUsers() {
        $users = [];
        foreach (json_decode($this->users) as $user) {
            $grp = new User();
            $grp->getByID($user);
            if ($grp->id != 0) {
                $users[] = $grp;
            }
        }
        return $users;
    }

    /*
     * Add user to company
     */

    public function addToCompany($id) {
        $groups = json_decode($this->users);
        foreach ($groups as $group) {
            if ($group == $id) {
                return;
            }
        }
        $groups[] = $id;
        $this->users = json_encode($groups);
        $this->update();
    }

    /*
     * Remove user from company
     */

    public function removeFromCompany($id) {
        $groups = json_decode($this->users);
        $newGroups = [];
        for ($i = 0; $i < count($groups); $i++) {
            if ($groups[$i] != $id) {
                $newGroups[] = $groups[$i];
            }
        }
        $this->users = json_encode($newGroups);
        $this->update();
    }
}
