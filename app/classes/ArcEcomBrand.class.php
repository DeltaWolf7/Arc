<?php

class ArcEcomBrand extends DataProvider {

    public $name;
    public $image;

    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->image = "";
        $this->table = ARCDBPREFIX . "ecom_brands";
        $this->map = ["id" => "id", "name" => "name", "image" => "image"];
    }

    public static function getByID($id) {
        $brand = new ArcEcomBrand();
        $brand->get(["id" => $id, "LIMIT" => 1]);
        return $brand;
    }

    public static function getByName($name) {
        $brand = new ArcEcomBrand();
        $brand->get(["name" => $name, "LIMIT" => 1]);
        return $brand;
    }

    public static function getAll() {
        $brands = new ArcEcomBrand();
        return $brands->getCollection([]);
    }
}