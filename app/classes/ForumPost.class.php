<?php


class ForumPost extends DataProvider {

    public $posterid;
    public $parentid;
    public $subject;
    public $content;
    public $posted;
    public $categoryid;

    public function __construct() {
        parent::__construct();
        $this->posterid = 0;
        $this->subject = "";
        $this->content = "";
        $this->posted = date("y-m-d H:i:s");
        $this->categoryid = 0;
        $this->parentid = 0;
        $this->table = ARCDBPREFIX . "forum_posts";
        $this->map = ["id" => "id", "posterid" => "posterid",
             "subject" => "subject", "content" => "content", "posted" => "posted",
             "categoryid" => "categoryid", "parentid" => "parentid"];
    }

    public static function getPosts($category = 0) {
        $posts = new ForumPost();
        return $posts->getCollection(["categoryid" => $category,
         "ORDER" => ["posted" => "ASC"]]);
    }

    public static function getReplies($parentid) {
        $posts = new ForumPost();
        return $posts->getCollection(["parentid" => $parentid,
         "ORDER" => ["posted" => "ASC"]]);
    }

    public static function getByID($id) {
        $post = new ForumPost();
        $post->get(["id" => $id, "LIMIT" => 1]);
        return $post;
    }
}