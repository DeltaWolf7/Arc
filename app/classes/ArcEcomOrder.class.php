<?php

class ArcEcomOrder extends DataProvider {

    public $date;
    public $userid;
    public $subtotal;
    public $vat;
    public $total;
    public $shipping;
    public $status;
    public $billing;
    public $shippingtypeid;
    public $paymentdata;
    public $weight;
    public $shippingprice;
    public $tracking;
    public $dropshiporder;

    public function __construct() {
        parent::__construct();
        $this->date = date("y-m-d H:i:s");
        $this->userid = 0;
        $this->subtotal = 0.00;
        $this->vat = 0.00;
        $this->total = 0.00;
        $this->status = "New";
        $this->shipping = 0.00;
        $this->billing = "";
        $this->shipping = "";
        $this->shippingtypeid = 0;
        $this->weight = 0.00;
        $this->shippingprice = 0.00;
        $this->paymentdata = [];
        $this->tracking = "";
        $this->dropshiporder = "";
        $this->table = ARCDBPREFIX . "ecom_orders";
        $this->map = ["id" => "id", "date" => "date", "userid" => "userid", "subtotal" => "subtotal", "vat" => "vat",
             "total" => "total", "status" => "status", "shipping" => "shipping", "billing" => "billing",
              "shippingtypeid" => "shippingtypeid", "paymentdata" => "paymentdata",
               "weight" => "weight", "shippingprice" => "shippingprice", "tracking" => "tracking", "dropshiporder" => "dropshiporder"];
    }

    public static function getByID($id) {
        $order = new ArcEcomOrder();
        $order->get(["id" => $id, "LIMIT" => 1]);
        return $order;
    }

    public static function getByUserID($userid) {
        $orders = new ArcEcomOrder();
        return $orders->getCollection(["userid" => $userid, "LIMIT" => 1]);
    }

    public static function getAll() {
        $orders = new ArcEcomOrder();
        return $orders->getCollection(["ORDER" => ['date' => 'DESC']]);
    }

    public static function getByStatus($status) {
        $orders = new ArcEcomOrder();
        return $orders->getCollection(["status" => $status]);
    }

    public function delete() {
        $orderLines = ArcEcomOrderLine::getByOrderID($this->id);
        foreach ($orderLines as $line) {
            $line->delete();
        }
        parent::delete();
    }
}