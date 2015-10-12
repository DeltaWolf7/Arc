<?php

/*
 * The MIT License
 *
 * Copyright 2015 clongford.
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

class AccessKey extends UserSetting {

    public function __construct() {
        parent::__construct();
    }

    public static function getUserByKey($key) {
        $setting = new UserSetting();
        $setting->get(["AND" => ["key" => "ACCESSKEY", "setting" => $key]]);

        if ($setting->userid == 0) {
            return null;
        }
        
        $user = new User();
        $user->getByID($setting->userid);
        return $user;
    }
    
    public static function getUserKey($userid) {
        $setting = new UserSetting();
        $setting->get(["AND" => ["key" => "ACCESSKEY", "userid" => $userid]]);

        if ($setting->userid == 0) {
            return null;
        }
        return $setting;
    }
    
    public static function createKey($userid) {
        if (AccessKey::getUserKey($userid) == null) {
            $setting = new UserSetting();
            $setting->key = "ACCESSKEY";
            $setting->userid = $userid;
            $setting->setting = AccessKey::generateKey();
            $setting->update();
        }
    }

    public static function generateKey() {
        $key = com_create_guid();
        $key = str_replace("{", "", $key);
        $key = str_replace("}", "", $key);
        return $key;
    }
}