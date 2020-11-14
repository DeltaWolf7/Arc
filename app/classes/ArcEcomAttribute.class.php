<?php

class ArcEcomAttribute extends DataProvider {

    public $typeid;
    public $value;
    public $productid;
    public $priceadjust;
    public $stock;

    public function __construct() {
        parent::__construct();
        $this->typeid = 0;
        $this->value = 0.00;
        $this->productid = 0;
        $this->priceadjust = 0.00;
        $this->stock = 0;
        $this->table = ARCDBPREFIX . "ecom_attributes";
        $this->map = ["id" => "id", "typeid" => "typeid", "value" => "value", "productid" => "productid", 
            "priceadjust" => "priceadjust", "stock" => "stock"];
    }

    public static function getByID($id) {
        $attribute = new ArcEcomAttribute();
        $attribute->get(["id" => $id]);
        return $attribute;
    }

    public static function getByProductIDAndTypeAndValue($productid, $type, $value) {
        $attribute = new ArcEcomAttribute();
        $attribute->get(["productid" => $productid, "typeid" => $type, "value" => $value]);
        return $attribute;
    }

    public static function getByProductIDAndType($productid, $type) {
        $attribute = new ArcEcomAttribute();
        $attribute->get(["productid" => $productid, "typeid" => $type]);
        return $attribute;
    }

    public static function getAllByProductID($productid) {
        $attribute = new ArcEcomAttribute();
        return $attribute->getCollection(["productid" => $productid]);
    }

    public static function getAllByProductIDAndType($productid, $type) {
        $attribute = new ArcEcomAttribute();
        return $attribute->getCollection(["productid" => $productid, "typeid" => $type]);
    }

    public static function getAll() {
        $attribute = new ArcEcomAttribute();
        return $attribute->getCollection([]);
    }
}