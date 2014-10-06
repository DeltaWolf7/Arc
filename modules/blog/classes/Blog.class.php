<?php

class Blog extends DataProvider {
   
    public $date;
    public $title;
    public $content;
    public $image;
    public $tags;
    public $posterid;
    public $categoryid;
    public $seourl;
    
    public function __construct() {
        parent::__construct();
        $this->date = date("y-m-d h:i:s");
        $this->title = "";
        $this->content = "";
        $this->image = "";
        $this->tags = "";
        $this->posterid = 0;
        $this->categoryid = 0;
        $this->seourl = "";
        $this->table = ARCDBPREFIX . "blog";
        $this->columns = ["id", "date", "title", "content", "image", "tags", "posterid", "categoryid", "seourl"];
    }
    
    public static function getAllByCategory($catid) {
        $blogs = new Blog();
        return $blogs->getCollection(["categoryid" => $catid, "ORDER" => "date ASC"]);
    }
    
    public static function getLatest($count = 10) {
        $blogs = new Blog();
        return $blogs->getCollection(["ORDER" => "date ASC", "LIMIT" => $count]);
    }
    
    public static function getBySEOUrl($url) {
        $blog = new Blog();
        $blog->get(["SEOUrl" => $url]);
        return $blog;
    }
}
