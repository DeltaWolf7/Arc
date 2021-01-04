<?php

class ArcEcomOrderStatus extends DataProvider {

    public $name;

    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->table = ARCDBPREFIX . "ecom_orderstatus";
        $this->map = ["id" => "id", "name" => "name"];
    }

    public static function getByID($id) {
        $brand = new ArcEcomOrderStatus();
        $brand->get(["id" => $id, "LIMIT" => 1]);
        return $brand;
    }

    public static function getAll() {
        $brands = new ArcEcomOrderStatus();
        return $brands->getCollection([]);
    }
}