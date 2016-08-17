<?php

class ArcDeskPriority extends DataProvider {
    
    public $name;
    public $sortorder;
    
    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->sortorder = 0;
        $this->table = "arcdesk_priority";
        $this->map = ["id" => "id", "name" => "name", "sortorder" => "sortorder"];
        $this->columns = ["id", "name", "sortorder"];
    }
    
    public static function getByID($id) {
        $status = new ArcDeskPriority();
        $status->get(["id" => $id]);
        return $status;
    }
}
