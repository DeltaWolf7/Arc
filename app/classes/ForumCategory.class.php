<?php

class ForumCategory extends DataProvider {

    public $parentid;
    public $name;
    public $description;
    public $allowpost;

    public function __construct() {
        parent::__construct();
        $this->parentid = 0;
        $this->name = "";
        $this->description = "";
        $this->allowpost = true;
        $this->table = ARCDBPREFIX . "forum_categories";
        $this->map = ["id" => "id", "parentid" => "parentid",
             "name" => "name", "description" => "description",
              "allowpost" => "allowpost"];
    
    }

    public static function getByID($id) {
        $category = new ForumCategory();
        $category->get(["id" => $id, "LIMIT" => 1]);
        return $category;
    }

    public static function getCategories($parent = 0) {
        $categories = new ForumCategory();
        return $categories->getCollection(["parentid" => $parent, "ORDER" => ["name" => "ASC"]]);
    }

    public function getPostCount() {
        $category = new ForumPost();
        return $category->getCount(["categoryid" => $this->id]);
    }

}