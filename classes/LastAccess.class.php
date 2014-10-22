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
 * Description of lastaccess
 *
 * @author Craig Longford
 */
class LastAccess extends DataProvider {

    public $userid;
    public $when;
    public $browser;
    public $ipaddress;

    /**
     * LastAccess constructor
     */
    public function __construct() {
        parent::__construct();
        $this->userid = 0;
        $this->when = date("y-m-d h:i:s");
        $this->browser = "";
        $this->ipaddress = "";
        $this->table = ARCDBPREFIX . "last_access";
        $this->columns = ["id", "userid", "when", "browser", "ipaddress"];
    }

    /**
     * 
     * @param int $userid User's ID
     * @return \LastAccess collection
     */
    public static function getByUserID($userid) {
        $access = new LastAccess();
        return $access->getCollection(["userid" => $userid, "ORDER" => "when DESC"]);
    }

    /**
     * 
     * @param int $userid User's ID
     * Logs the users browser details and IP address
     */
    public static function logAccess($userid) {
        $access = new LastAccess();
        $access->userid = $userid;
        $access->browser = $_SERVER["HTTP_USER_AGENT"];
        $access->ipaddress = $_SERVER["REMOTE_ADDR"];
        $access->update();
    }
}