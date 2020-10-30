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

    public static function getAllCategoriesByParentID($parentid = 0) {
        $categories = new ArcEcomCategory();
        return $categories->getCollection(["parentid" => $parentid]);
    }
}