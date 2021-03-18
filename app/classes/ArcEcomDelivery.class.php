<?php

class ArcEcomDelivery extends DataProvider {

    public $name;
    public $price;
    public $maxweightkg;
    public $enabled;

    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->price = 0.00;
        $this->maxweightkg = 0.00;
        $this->enabled = 1;
        $this->table = ARCDBPREFIX . "ecom_deliveries";
        $this->map = ["id" => "id", "name" => "name", "price" => "price", "maxweightkg" => "maxweightkg", "enabled" => "enabled"];
    }

    public static function getByID($id) {
        $delivery = new ArcEcomDelivery();
        $delivery->get(["id" => $id, "LIMIT" => 1]);
        return $delivery;
    }

    public static function getAll() {
        $delivery = new ArcEcomDelivery();
        return $delivery->getCollection([]);
    }

    public static function getAllEnabled() {
        $delivery = new ArcEcomDelivery();
        return $delivery->getCollection(["Enabled" => "1"]);
    }
}