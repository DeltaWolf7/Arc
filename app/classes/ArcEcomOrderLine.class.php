<?php

class ArcEcomOrderLine extends DataProvider {

    public $orderid;
    public $productid;
    public $options;
    public $cost;
    public $price;
    public $description;
    public $qty;

    public function __construct() {
        parent::__construct();
        $this->productid = 0;
        $this->options = [];
        $this->cost = 0.00;
        $this->price = 0.00;
        $this->description = "";
        $this->qty = 0;
        $this->table = ARCDBPREFIX . "ecom_orderlines";
        $this->map = ["id" => "id", "orderid" => "orderid", "productid" => "productid", "options" => "options [JSON]", "cost" => "cost",
             "price" => "price", "description" => "description", "qty" => "qty"];
    }

    public static function getByID($id) {
        $line = new ArcEcomOrderLine();
        $line->get(["id" => $id]);
        return $line;
    }

    public static function getByOrderID($orderid) {
        $products = new ArcEcomOrderLine();
        return $products->getCollection(["orderid" => $orderid]);
    }
}