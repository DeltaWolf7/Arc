<?php

class ArcDeskSkill extends DataProvider {
    
    public $userid;
    public $skill;
    public $level;
    
    public function __construct() {
        parent::__construct();
        $this->userid = 0;
        $this->skill = "";
        $this->level = "";
        $this->table = "arcdesk_skillmatrix";
        $this->map = ["id" => "id", "userid" => "userid", "skill" => "skill", "level" => "level"];
        $this->columns = ["id", "userid", "skill", "level"];
    }
}
