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

/**
 * Description of Order
 *
 * @author craig
 */
class Order extends DataProvider {

    public $ordernumber;
    public $orderdate;
    public $userid;
    public $deliveryid;
    public $billingid;
    public $postage;
    public $subtotal;
    public $vattotal;
    public $status;

    public function __construct() {
        parent::__construct();
        $this->billingid = 0;
        $this->deliveryid = 0;
        $this->orderdate = date("d-m-Y h:i:s");
        $this->ordernumber = "";
        $this->postage = 0.0;
        $this->status = "Pending";
        $this->subtotal = 0.0;
        $this->userid = 0;
        $this->vattotal = 0.0;
        $this->table = ARCDBPREFIX . "store_orders";
        $this->columns = ["id", "ordernumber", "orderdate", "userid", "deliveryid", "billingid", "postage", "subtotal", "vattotal", "status"];
    }

    public static function getNextOrderNumber() {
        $setting = SystemSetting::getByKey("ARC_STORE_ORDERNUMBER");
        if ($setting->id == 0) {
            $setting->value = 100000;
        }
        $setting->value = (((int) $setting->value) + 1);
        $setting->update();
        return $setting->value;
    }
    
    public function getOrderlines() {
        $orderlines = new OrderLine();
        return $orderlines->getCollection(["orderid" => $this->id]);
    }
}
