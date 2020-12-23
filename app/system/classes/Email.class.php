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
 * Email object
 */
class Email extends DataProvider {

    // Unique key used by the setting
    public $key;
    // Subject
    public $subject;
    // Email body
    public $text;
    // System required?
    public $protected;


    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        $this->key = "";
        $this->subject = "";
        $this->text = "";
        $this->protected = false;
        $this->table = ARCDBPREFIX . "emails";
        $this->map = ["id" => "id", "key" => "key", "subject" => "subject", "text" => "text", "protected" => "protected"];
    }

    /**
     * Get email by its Key
     * @param string $key
     * @return \Email
     */
    public static function getByKey($key) {
        $setting = new Email();
        $setting->get(["key" => $key]);
        return $setting;
    }

    /**
     * Get all the emails from the database.
     * @return Array
     */
    public static function getAll() {
        $settings = new SystemSetting();
        return $settings->getCollection([]);
    }
}
