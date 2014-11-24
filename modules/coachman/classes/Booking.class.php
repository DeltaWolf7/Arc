<?php

/* 
 * The MIT License
 *
 * Copyright 2014 craig.
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

class Booking extends DataProvider {
    
    public $reference;
    public $journeydate;
    public $customername;
    public $customerid;
    public $address;
    public $email;
    public $phone;
    public $mobile;
    public $company;
    public $orderdate;
    public $coachsize;
    public $departureaddress;
    public $arrivaltime;
    public $departuretime;
    public $destination;
    public $returndate;
    public $returntime;
    public $returnplace;
    public $returndropoff;
    public $cost;
    public $deposit;
    
    public function __construct() {
        parent::__construct();
        $this->table = "coachman_bookings";
        $this->columns = ["id", "reference", "journeydate", "customername", "customerid", "address", "email", "phone",
            "mobile", "company", "orderdate", "coachsize", "departureaddress", "arrivaltime", "departuretime", "destination", "returndate",
            "returndropoff", "cost", "deposit", "returntime", "returnplace"];
        $this->reference = "";
        $this->journeydate = date("d-m-Y");
        $this->customername = "";
        $this->customerid = 0;
        $this->address = "";
        $this->email = "";
        $this->phone = "";
        $this->mobile = "";
        $this->company = "";
        $this->orderdate = date("d-m-Y");
        $this->coachsize = 0;
        $this->departureaddress = "";
        $this->arrivaltime = date("h:i:s");
        $this->departuretime = date("h:i:s");
        $this->destination = "";
        $this->returndate = date("d-m-Y");
        $this->returnplace = "";
        $this->returndropoff = "";
        $this->cost = 0.0;
        $this->deposit = 0.0;
        $this->returntime = date("h:i:s");
    }
    
    public static function getNextReference() {
        $setting = SystemSetting::getByKey("COACHMAN_REF");
        if ($setting->id == 0) {
            $setting->key = "COACHMAN_REF";
            $setting->setting = 100000;
        }
        $setting->setting = (int)$setting->setting + 1;
        $setting->update();
        return $setting->setting;
    }
    
    public static function getBookingsByMonth($month) {
        $bookings = new Booking();
        return $bookings->getCollection([]);
    }
}