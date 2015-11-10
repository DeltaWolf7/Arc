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
 * Description of system setting
 *
 * @author Craig Longford
 */
class SystemSetting extends DataProvider {

    public $key;
    public $value;
    public $group;
    public $userid;

    /**
     * SystemSetting constructor
     */
    public function __construct() {
        parent::__construct();
        $this->key = "";
        $this->value = "";
        $this->userid = 0;
        $this->group = "Ungrouped";
        $this->table = ARCDBPREFIX . "system_settings";
        $this->columns = ["key", "value", "group", "userid"];
    }

    /**
     * 
     * @param string $key Key of the setting
     * @param int $id User ID of the setting
     * @return \SystemSetting setting if it exists
     */
    public static function getByKey($key, $userid = 0) {
        $setting = new SystemSetting();
        $setting->get(["AND" => ["key" => $key, "userid" => $userid]]);
        // if no setting was found in the database, return empty setting with key.
        if (empty($setting->key)) {
            $setting->key = $key;
        }
        return $setting;
    }

    /**
     * 
     * @param string $key string value as key
     * @return \SystemSetting
     */
    public static function keyExists($key, $userid = 0) {
        $setting = new SystemSetting();
        $setting->get(["AND" => ["key" => $key, "userid" => $userid]]);
        if (empty($setting->key)) {
            return false;
        }
        return true;
    }

    /**
     * 
     * @return array Containing the split values
     */
    public function getArrayFromJson() {
        return json_decode($this->value);
    }

    /**
     * 
     * @return array Collection of system settings
     */
    public static function getAll() {
        $settings = new SystemSetting();
        return $settings->getCollection(["userid" => "0", "ORDER" => "group ASC"]);
    }

    /*
     * Delete setting with key
     */
    public function delete($key, $id = 0) {
        system\Helper::arcGetDatabase()->delete($this->table, ["AND" => ["key" => $key, "userid" => $id]]);
    }
    
     /*
     * Update the setting and save it to the database
     */
    public function update() {
        $columns = array_slice($this->columns, 1);
        $dataColumns = array();
        $properties = get_object_vars($this);
        foreach ($this->columns as $column) {
            if ($column != "table" && $column != "columns") {
                $dataColumns[$column] = $properties[$column];
            }
        }
        $setting = SystemSetting::keyExists($this->key);
        if ($setting == false) {
            $dataColumns["key"] = $this->key;
            system\Helper::arcGetDatabase()->insert($this->table, $dataColumns);
        } else {
            system\Helper::arcGetDatabase()->update($this->table, $dataColumns, ["key" => $this->key]);
        }
    }
}
