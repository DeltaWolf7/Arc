<?php

class Comment extends DataProvider {
    
    public $issueid;
    public $posterid;
    public $comment;
    
    public function __construct() {
        parent::__construct();
        $this->issueid = 0;
        $this->posterid = 0;
        $this->comment = "";
        $this->columns = ["id", "issueid", "posterid", "comment"];
        $this->table = ARCDBPREFIX . "issue_comments";
    }
    
    public static function getByIssueID($issueid) {
        $comments = new Comment();
        return $comments->getCollection(["ORDER" => "id DESC", "issueid" => $issueid]);
    }
}
