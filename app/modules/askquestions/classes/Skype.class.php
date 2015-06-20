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
    public $booked;
    public $confirmed;

    public function __construct() {
        parent::__construct();
        $this->userid = 0;
        $this->booked = "";
        $this->confirmed = 0;
        $this->table = ARCDBPREFIX . "skype";
        $this->columns = ["id", "userid", "booked", "confirmed"];
    }
    
    public static function getByDate($date) {
        $skype = new Skype();
        $skype->get(["booked" => $date]);
        return $skype;
    }
    
    public static function getByDateLike($date) {
        $skype = new Skype();
        return $skype->getCollection(["booked[~]" => $date . "%"]);
    }
    
    public static function getBookings($confirmed) {
        $skype = new Skype();
        return $skype->getCollection(["confirmed" => $confirmed, "ORDER" => "booked ASC"]);
    }
}
