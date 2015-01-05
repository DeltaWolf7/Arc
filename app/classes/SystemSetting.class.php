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

    /**
     * SystemSetting constructor
     */
    public function __construct() {
        parent::__construct();
        $this->key = "";
        $this->value = "";
        $this->table = ARCDBPREFIX . "system_settings";
        $this->columns = ["key", "value"];
    }

    /**
     * 
     * @param string $key Key of the setting
     * @return \SystemSetting setting if it exists
     */
    public static function getByKey($key) {
        $setting = new SystemSetting();
        $setting->get(["key" => $key]);

        // if no setting was found in the database, return empty setting with key.
        if (empty($setting->key)) {
            $setting->key = $key;
        }
        return $setting;
    }
    
    public static function keyExists($key) {
        $setting = new SystemSetting();
        $setting->get(["key" => $key]);
        return $setting;
    }

    /**
     * 
     * @param string $deliminater Deliminator to split the setting with.
     * @return array Containing the split values
     */
    public function getArray($deliminater = ",") {
        return explode($deliminater, $this->value);
    }

    /**
     * 
     * @return array Collection of system settings
     */
    public static function getAll() {
        $settings = new SystemSetting();
        return $settings->getCollection(["ORDER" => "key ASC"]);
    }

    public function delete($key) {
        system\Helper::arcGetDatabase()->delete($this->table, ["key" => $key]);
    }

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
        if (empty($setting->key)) {
            $dataColumns["key"] = $this->key;
            system\Helper::arcGetDatabase()->insert($this->table, $dataColumns);
        } else {
            system\Helper::arcGetDatabase()->update($this->table, $dataColumns, ["key" => $this->key]);
        }
    }

}
