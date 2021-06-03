<?php

/* 
 * The MIT License
 *
 * Copyright 2021 Craig Longford (deltawolf7@gmail.com).
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
 * Log object
 */
class Log extends DataProvider {

    // Log message
    public $message;
    // Log event time/date
    public $event;
    // Log type (warning, danger, info, success)
    public $type;
    // Module the log applies to
    public $module;
    public $impersonate;
    public $userid;
    public $sessionid;
 
    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        // Initilise event datetime to now
        $this->event = date("y-m-d H:i:s");
        // Initilise message
        $this->message = "";
        $this->impersonate = false;
        $this->userid = 0;
        $this->sessionid = session_id();
        // Set the table used by the object
        $this->table = ARCDBPREFIX . 'logs';
        // Set the property to column mapping
        $this->map = ["id" => "id", "type" => "type", "module" => "module", "event" => "event",
                     "message" => "message", "impersonate" => "impersonate", "userid" => "userid", "sessionid" => "sessionid"];
    }

    /**
     * Get all logs from the database
     * @return array Collection of log objects
     */
    public static function getLogs($page, $number) {
        // Create a new log class
        $logs = new Log();
        // Return collection of log objects
        return $logs->getCollection(['ORDER' => ['id' => 'DESC'], "LIMIT" => [$number * $page, $number]]);
    }

    public static function getByUserID($userid, $page, $number) {
        // Create a new log class
        $logs = new Log();
        // Return collection of log objects
        return $logs->getCollection(['userid' => $userid, 'ORDER' => ['id' => 'DESC'], "LIMIT" => [$number * $page, $number]]);
    }

    public static function search($query, $page, $number) {
        // Create a new log class
        $logs = new Log();
        // Return collection of log objects
        return $logs->getCollection(["OR" => ["message[~]" => $query, "sessionid[~]" => $query], 'ORDER' => ['id' => 'DESC'], "LIMIT" => [$number * $page, $number]]);
    }

        /**
     * Clear logs table
     */
    public static function clear() {
        $logs = new Log();
        $data = system\Helper::arcGetDatabase()->query("TRUNCATE " . $logs->table);
    }
       
    /**
     * Count the number of logs in the database
     * @return int Log count
     */
    public static function count($userid = 0) {
        // Create a new log class
        $logs = new Log();
        // Return the number of logs
        if ($userid == 0) {
            return $logs->getCount([]);
        } else {
            return $logs->getCount(["userid" => $userid]);
        }
    }
    
    /**
     * Create a log entry, save it to the database and purge old logs based on settings
     * @param string $type Values: success, warning, error
     * @param string $module Module name (source of the log)
     * @param string $message Log entry/message
     */
    public static function createLog($type, $module, $message) {
        // Create a new log class
        $log = new Log();
        // Set the type
        $log->type = $type;
        // Set the module
        $log->module = $module;
        // set the message
        $log->message = $message;
        // set user details
        $log->impersonate = system\Helper::arcIsImpersonator();
        $user = system\Helper::arcGetUser();
        if ($user != null) {
            $log->userid = $user->id;
        }
        // Update log in database
        $log->update();
    }
}
