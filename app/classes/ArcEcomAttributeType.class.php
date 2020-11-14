<?php

class ArcEcomAttributeType extends DataProvider {

    public $name;
    public $isoption;

    public function __construct() {
        parent::__construct();
        $this->name = 0;
        $this->isoption = false;
        $this->table = ARCDBPREFIX . "ecom_attribute_types";
        $this->map = ["id" => "id", "name" => "name", "isoption" => "isoption"];
    }

    public static function getByID($id) {
        $attribute = new ArcEcomAttributeType();
        $attribute->get(["id" => $id]);
        return $attribute;
    }

    public static function getByName($name) {
        $attribute = new ArcEcomAttributeType();
        $attribute->get(["name" => $name]);
        return $attribute;
    }
}