<?php

class ArcEcomCategory extends DataProvider {

    public $parentid;
    public $name;
    public $image;

    public function __construct() {
        parent::__construct();
        $this->parentid = 0;
        $this->name = "";
        $this->image = "";
        $this->table = ARCDBPREFIX . "ecom_categories";
        $this->map = ["id" => "id", "parentid" => "parentid", "name" => "name", "image" => "image"];
    }

    public static function getByID($id) {
        $category = new ArcEcomCategory();
        $category->get(["id" => $id]);
        return $category;
    }

    public static function getAll() {
        $categories = new ArcEcomCategory();
        return $categories->getCollection([]);
    }

    public static function getAllCategoriesByParentID($parentid = 0) {
        $categories = new ArcEcomCategory();
        return $categories->getCollection(["parentid" => $parentid]);
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