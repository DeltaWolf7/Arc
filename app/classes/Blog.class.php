<?php

class Blog extends DataProvider {

    public $date;
    public $title;
    public $content;
    public $image;
    public $tags;
    public $poster;
    public $categoryid;
    public $seourl;

    public function __construct() {
        parent::__construct();
        $this->date = date("y-m-d H:i:s");
        $this->title = "";
        $this->content = "";
        $this->image = "";
        $this->tags = "";
        $this->poster = 0;
        $this->categoryid = 0;
        $this->seourl = "";
        $this->table = ARCDBPREFIX . "blog";
        $this->map = ["id" => "id", "date" => "date", "title" => "title", "content" => "content", "image" => "image",
            "tags" => "tags", "poster" => "poster", "categoryid" => "categoryid", "seourl" => "seourl"];
    }

    public static function getByID($id) {
        $blog = new Blog();
        $blog->get(["id" => $id, "LIMIT" => 1]);
        return $blog;
    }

    public static function getAllBlogs() {
        $blogs = new Blog();
        return $blogs->getCollection(["ORDER" => ["date" => "DESC"]]);
    }

    public static function getAllByCategoryID($id) {
        $blogs = new Blog();
        return $blogs->getCollection(["categoryid" => $id, "ORDER" => ["date" => "DESC"]]);
    }
    
    public static function getLatest($count = 10) {
        $blogs = new Blog();
        return $blogs->getCollection(["ORDER" => ["date" => "DESC"], "LIMIT" => $count]);
    }

    public static function getBySEOUrl($url) {
        $blog = new Blog();
        $blog->get(["SEOUrl" => $url, "LIMIT" => 1]);
        return $blog;
    }

    public function getCategory() {
        return BlogCategory::getByID($this->categoryid);
    }
  
    public function getPoster() {
        return User::getByID($this->poster);
    }

    public function getImage() {
        if (!empty($this->image)) {
            return system\Helper::arcGetPath() . "assets/arcblog/" . $this->image;
        }
        return system\Helper::arcGetPath() . "assets/arcblog/placeholder.png";
    }

    public function getUrl() {
        return system\Helper::arcGetPath() . "blog/post/" .  $this->seourl;
    }
}
