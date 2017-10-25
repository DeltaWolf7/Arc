<?php

class BlogCategory extends DataProvider {

    public $name;
    public $seourl;
    public $id;

    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->seourl = "";
        $this->allowpost = true;
        $this->table = ARCDBPREFIX . "blog_categories";
        $this->map = ["id" => "id", "name" => "name",
             "seourl" => "seourl"];
    }

    public static function getByID($id) {
        $category = new BlogCategory();
        $category->get(["id" => $id]);
        return $category;
    }

    public static function getAllCategories() {
        $categories = new BlogCategory();
        return $categories->getCollection(["ORDER" => ["name" => "ASC"]]);
    }

    public static function getBySEOUrl($url) {
        $category = new BlogCategory();
        $category->get(["SEOUrl" => $url]);
        return $category;
    }

    /**
     * 
     * @param string $name Name of the group
     * @return \UserGroup
     */
    public static function getByName($name) {
        $group = new BlogCategory();
        $group->get(["name" => $name]);
        return $group;
    }

    public function getUrl() {
        return system\Helper::arcGetPath() . "blog/category/" . $this->seourl;
    }

}
