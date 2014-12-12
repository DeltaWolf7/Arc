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
     * Description of user setting
     *
     * @author Craig Longford
     */
    class UserSetting extends DataProvider {

        public $key;
        public $userid;
        public $setting;

        /**
         * UserSetting constructor
         */
        public function __construct() {
            parent::__construct();
            $this->key = "";
            $this->userid = 0;
            $this->setting = "";
            $this->table = ARCDBPREFIX . "user_settings";
            $this->columns = ["id", "key", "userid", "setting"];
        }

        /**
         * 
         * @param int $userid User's ID
         * @param string $key Key of the setting
         * @return \UserSetting
         */
        public static function getByUserID($userid, $key) {
            $setting = new UserSetting();
            $setting->get(["AND" => ["userid" => $userid, "key" => $key]]);

            // if no setting was found in the database, return empty setting with userid and key.
            if ($setting->userid == 0) {
                $setting->userid = $userid;
                $setting->key = $key;
            }
            return $setting;
        }

    }

