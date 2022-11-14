<?php

/* 
 * The MIT License
 *
 * Copyright 2022 Craig Longford (deltawolf7@gmail.com).
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
 * APIKey object
 */
class APIKey extends DataProvider {

    public $userid;
    public $apikey;
    public $secrethash;
 
    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        $this->userid = 0;
        $this->apikey = "";
        $this->secrethash = "";
        // Set the table used by the object
        $this->table = ARCDBPREFIX . 'apikeys';
        // Set the property to column mapping
        $this->map = ["id" => "id", "userid" => "userid", "apikey" => "apikey", "secrethash" => "secrethash"];
    }

    public static function getByID($id) {
        $apikey = new APIKey();
        $apikey->get(["id" => $id, "LIMIT" => 1]);
        return $apikey;
    }

    public static function getByKey($key) {
        $apikey = new APIKey();
        $apikey->get(["apikey" => $key, "LIMIT" => 1]);
        return $apikey;
    }

    public static function getAll() {
        $apikey = new APIKey();
        return $apikey->getCollection(['ORDER' => ['id' => 'DESC']]);
    }

    public static function getByUserID($userid) {
        $apikey = new APIKey();
        return $apikey->getCollection(['userid' => $userid, "LIMIT" => 1]);
    }  
    
    public static function createSecret() {
        return bin2hex(random_bytes(50));
    }

    public static function hashSecret($secret) {
        return password_hash($secret, PASSWORD_DEFAULT);
    }

    public function verifySecret($secret) {
        return password_verify($secret, $this->secrethash);
    }
}
