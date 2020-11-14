<?php

class ArcEcomOrder extends DataProvider {

    public $date;
    public $userid;
    public $subtotal;
    public $vat;
    public $total;
    public $shipping;
    public $shippingid;
    public $status;
    public $billingid;
    public $shippingtypeid;
    public $paymentdata;

    public function __construct() {
        parent::__construct();
        $this->date = date("y-m-d H:i:s");
        $this->userid = 0;
        $this->subtotal = 0.00;
        $this->vat = 0.00;
        $this->total = 0.00;
        $this->status = 1;
        $this->shipping = 0.00;
        $this->billingid = 0;
        $this->shippingid = 0;
        $this->shippingtypeid = 0;
        $this->paymentdata = [];
        $this->table = ARCDBPREFIX . "ecom_orders";
        $this->map = ["id" => "id", "date" => "date", "userid" => "userid", "subtotal" => "subtotal", "vat" => "vat",
             "total" => "total", "status" => "status", "shipping" => "shipping", "billingid" => "billingid",
              "shippingid" => "shippingid", "shippingtypeid" => "shippingtypeid", "paymentdata" => "paymentdata"];
    }

    public static function getByID($id) {
        $order = new ArcEcomOrder();
        $order->get(["id" => $id]);
        return $order;
    }

    public static function getByUserID($userid) {
        $orders = new ArcEcomOrder();
        return $orders->getCollection(["userid" => $userid]);
    }

    public function delete() {
        $orderLines = ArcEcomOrderLine::getByOrderID($this->id);
        foreach ($orderLines as $line) {
            $line->delete();
        }
        parent::delete();
    }
}