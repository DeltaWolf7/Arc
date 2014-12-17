<?php

class BlogCategory extends DataProvider {
   
    public $name;
    public $seourl;
    
    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->seourl = "";
        $this->table = ARCDBPREFIX . "blog_categories";
        $this->columns = ["id", "name", "seourl"];
    }
    
    public static function getAllCategories() {
        $categories = new BlogCategory();
        return $categories->getCollection(["ORDER" => "name ASC"]);
    }
    
    public static function getBySEOUrl($url) {
        $category = new BlogCategory();
        $category->get(["SEOUrl" => $url]);
        return $category;
    }
}