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
 * System Setting object
 */
class SystemSetting extends DataProvider {

    // Unique key used by the setting
    public $key;
    // The value of the setting
    public $value;
    // Associated user or 0 for system
    public $userid;

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        $this->key = "";
        $this->value = "";
        $this->userid = 0;
        $this->table = ARCDBPREFIX . "system_settings";
        $this->map = ["id" => "id", "key" => "skey", "value" => "svalue", "userid" => "userid"];
    }

    /**
     * Get setting by its Key and User ID, if required
     * @param type $key
     * @param type $userid
     * @return \SystemSetting
     */
    public static function getByKey($key, $userid = 0) {
        $setting = new SystemSetting();
        $setting->get(["AND" => ["skey" => $key, "userid" => $userid]]);
        // if no setting was found in the database, return empty setting with key.
        if (empty($setting->key)) {
            $setting->key = $key;
            $setting->userid = $userid;
        }
        return $setting;
    }

    /**
     * Check is the setting already exists by Key and User ID, if required
     * @param type $key
     * @param type $userid
     * @return boolean
     */
    public static function keyExists($key, $userid = 0) {
        $setting = new SystemSetting();
        $setting->get(["AND" => ["skey" => $key, "userid" => $userid]]);
        if (empty($setting->key)) {
            return false;
        }
        return true;
    }

    /**
     * Get all the settings from the database by User ID, if required
     * @param type $userid
     * @return type
     */
    public static function getAll($userid = 0) {
        $settings = new SystemSetting();
        return $settings->getCollection(["userid" => $userid]);
    }
}
