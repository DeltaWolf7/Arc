<?php

class ArcDeskStatus extends DataProvider {
    
    public $name;
    
    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->columns = ["id", "name"];
        $this->table = "arcdesk_statuses";
    }
    
    public static function getByID($id) {
        $status = new ArcDeskStatus();
        $status->get(["id" => $id]);
        return $status;
    }
}
