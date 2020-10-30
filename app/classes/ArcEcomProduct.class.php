<?php

class ArcEcomProduct extends DataProvider {

    public $categoryid;
    public $name;
    public $model;
    public $cost;
    public $rrp;
    public $price;
    public $description;
    public $ean;
    public $brandid;
    public $stock;

    public function __construct() {
        parent::__construct();
        $this->categoryid = 0;
        $this->name = "";
        $this->model = "";
        $this->cost = 0.00;
        $this->rrp = 0.00;
        $this->price = 0.00;
        $this->description = "";
        $this->ean = "";
        $this->brandid = 0;
        $this->stock = 0;
        $this->table = ARCDBPREFIX . "ecom_products";
        $this->map = ["id" => "id", "categoryid" => "categoryid", "name" => "name", "model" => "model", "cost" => "cost",
             "rrp" => "rrp", "price" => "price", "description" => "description",
             "ean" => "ean", "brandid" => "brandid", "stock" => "stock"];
    }

    public static function getByID($id) {
        $product = new ArcEcomProduct();
        $product->get(["id" => $id]);
        return $product;
    }

    public static function getByModel($model) {
        $product = new ArcEcomProduct();
        $product->get(["model" => $model]);
        return $product;
    }

    public static function getAllByCategoryID($categoryid) {
        $products = new ArcEcomProduct();
        return $products->getCollection(["categoryid" => $categoryid]);
    }

    public static function getAll() {
        $products = new ArcEcomProduct();
        return $products->getCollection([]);
    }

    public function getSEOUrl()
    {
        $string = $this->name;
        $separator = '-';
        $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
        $special_cases = array( '&' => 'and', "'" => '');
        $string = mb_strtolower( trim( $string ), 'UTF-8' );
        $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
        $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
        $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
        $string = preg_replace("/[$separator]+/u", "$separator", $string);
        return rtrim($this->id . $separator . $string, "-");
    }
}