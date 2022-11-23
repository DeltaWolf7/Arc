<?php

class ArcServiceDeskComment extends DataProvider {

    public $userid;
    public $created;
    public $description;
    public $ticketid;

    public function __construct() {
        parent::__construct();
        $this->userid = 0;
        $this->created = date("y-m-d H:i:s");
        $this->ticketid = 0;
        $this->description = "";
        $this->table = ARCDBPREFIX . "servicedesk_comments";
        $this->map = ["id" => "id", "userid" => "userid", "created" => "created", 
                "description" => "description", "ticketid" => "ticketid"];
    }

    public static function getByID($id) {
        $comment = new ArcServiceDeskComment();
        $comment->get(["id" => $id, "LIMIT" => 1]);
        return $comment;
    }

    public static function getAllByTicketID($ticketid) {
        $comments = new ArcServiceDeskComment();
        return $comments->getCollection(["ticketid" => $ticketid, "ORDER" => "created"]);
    }
}