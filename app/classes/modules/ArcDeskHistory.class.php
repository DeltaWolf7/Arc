<?php

class ArcDeskHistory extends DataProvider {
    
    public $created;
    public $laststatus;
    public $newstatus;
    public $changeid;
    
    public function __construct() {
        parent::__construct();
        $this->created = date("y-m-d H:i:s");
        $this->laststatus = 0;
        $this->newstatus = 0;
        $this->changeid = 0;
        $this->table = "arcdesk_history";
        $this->map = ["id" => "id", "created" => "created", "laststatus" => "laststatus",
            "newstatus" => "newstatus", "changeid" => "changeid"];
        $this->columns = ["id", "created", "laststatus", "newstatus", "changeid"];
    }
}
