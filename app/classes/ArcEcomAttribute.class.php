<?php

class ArcEcomAttribute extends DataProvider {

    public $name;
    public $value;
    public $productid;
    public $priceadjust;
    public $isoption;
    public $stock;

    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->value = 0.00;
        $this->productid = 0;
        $this->priceadjust = 0.00;
        $this->isoption = false;
        $this->stock = 0;
        $this->table = ARCDBPREFIX . "ecom_attributes";
        $this->map = ["id" => "id", "name" => "name", "value" => "value", "productid" => "productid", 
            "priceadjust" => "priceadjust", "isoption" => "isoption", "stock" => "stock"];
    }

    public static function getByID($id) {
        $attribute = new ArcEcomAttribute();
        $attribute->get(["id" => $id]);
        return $attribute;
    }

    public static function getByProductIDAndNameAndValue($productid, $name, $value) {
        $attribute = new ArcEcomAttribute();
        $attribute->get(["productid" => $productid, "name" => $name, "value" => $value]);
        return $attribute;
    }

    public static function getByProductIDAndName($productid, $name) {
        $attribute = new ArcEcomAttribute();
        $attribute->get(["productid" => $productid, "name" => $name]);
        return $attribute;
    }

    public static function getAllByProductID($productid) {
        $attribute = new ArcEcomAttribute();
        return $attribute->getCollection(["productid" => $productid]);
    }

    public static function getAllByProductIDAndName($productid, $name) {
        $attribute = new ArcEcomAttribute();
        return $attribute->getCollection(["productid" => $productid, "name" => $name]);
    }
}