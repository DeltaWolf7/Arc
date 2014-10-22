<?php

class Excerpt extends DataProvider {
    
    public $content;
    public $name;
    
    public function __construct() {
        parent::__construct();
        $this->content = "";
        $this->table = "erudio_excerpts";
        $this->columns = ["id", "content", "name"];
    }
    
    public static function getRandom() {
        $excerpt = new Excerpt();
        $data = $excerpt->getCollection([]);
        shuffle($data);
        return $data[0];
    }
}

