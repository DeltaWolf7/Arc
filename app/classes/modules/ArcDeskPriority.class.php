<?php

class ArcDeskPriority extends DataProvider {
    
    public $name;
    public $sortorder;
    
    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->sortorder = 0;
        $this->table = "arcdesk_priority";
        $this->columns = ["id", "name", "sortorder"];
    }
}
