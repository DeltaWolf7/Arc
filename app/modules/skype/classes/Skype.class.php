<?php

/*
 * The MIT License
 *
 * Copyright 2015 craig.
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

class Skype extends DataProvider {

    public $userid;
    public $date;
    public $time;
    public $status;
    public $notes;

    public function __construct() {
        parent::__construct();
        $this->userid = 0;
        $this->date = "";
        $this->time = "";
        $this->status = 0;
        $this->table = ARCDBPREFIX . "skype";
        $this->columns = ["id", "userid", "date", "time", "status", "notes"];
    }
    
    public static function getByDate($date) {
        $skype = new Skype();
        return $skype->getCollection(["date" => $date, "ORDER" => "time ASC"]);
    }
    
    public static function getByDateAndStatus($date, $status) {
        $skype = new Skype();
        return $skype->getCollection(["AND" => ["date" => $date, "status" => $status], "ORDER" => "time ASC"]);
    }
    
    public static function getByDateAndTime($date, $time) {
        $skype = new Skype();
        return $skype->getCollection(["AND" => ["date" => $date, "time" => $time]]);
    }
       
    public static function getAllBookings() {
        $skype = new Skype();
        return $skype->getCollection(["ORDER" => "date, time ASC"]);
    }
}
