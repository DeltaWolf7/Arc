<?php

class ArcDeskNote extends DataProvider {
    
    public $ticketid;
    public $created;
    public $internal;
    public $createdby;
    public $note;
    
    public function __construct() {
        parent::__construct();
        $this->ticketid = 0;
        $this->created = date("y-m-d H:i:s");
        $this->internal = false;
        $this->createdby = 0;
        $this->note = "";
        $this->map = ["id" => "id", "ticketid" => "ticketid", "created" => "created",
            "internal" => "internal", "createdby" => "createdby", "note" => "note"];
        $this->columns = ["id", "ticketid", "created", "internal", "createdby", "note"];
        $this->table = "arcdesk_ticketnotes";
    }
}
