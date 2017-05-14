<?php

class ChatEntry extends DataProvider {

    public $sessionid;
    public $userid;
    public $event;
    public $message;

    public function __construct() {
        parent::__construct();
        $this->event = date("y-m-d H:i:s");
        $this->userid = 0;
        $this->sessionid = 0;
        $this->message = "";
        $this->table = ARCDBPREFIX . "chat_entries";
        $this->columns = ["id", "sessionid", "userid", "event", "message"];
        $this->map = ["id" => "id", "sessionid" => "sessionid",
            "userid" => "userid", "event" => "event", "message" => "message"];
    }

    public static function getByID($id) {
        $session = new ChatEntry();
        $session->get(["id" => $id]);
        return $session;
    }
}