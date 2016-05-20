<?php

class ArcDeskStatus extends DataProvider {
    
    public $name;
    
    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->columns = ["id", "name"];
        $this->table = "arcdesk_statuses";
    }
}
