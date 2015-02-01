<?php

class Post extends DataProvider {
    
    public $user;
    public $userid;
    public $posted;
    public $content;
    
    public function __construct() {
        parent::__construct();
        $this->user = "";
        $this->userid = 0;
        $this->posted = date("y-m-d h:i:s");
        $this->content = "";
        $this->table = ARCDBPREFIX . "wall";
        $this->columns = ["id", "user", "userid", "posted", "content"];
    }
    
    public static function getLatest($count = 10) {
        $posts = new Post();
        return $posts->getCollection(["ORDER" => "posted DESC", "LIMIT" => $count]);
    }
}

