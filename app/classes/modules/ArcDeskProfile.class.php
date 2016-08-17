<?php

class ArcDeskProfile extends DataProvider {
    
    public $userid;
    public $phone;
    public $mobile;
    public $skillid;
    public $xp;
    public $image;
    public $jobrole;
    
    public function __construct() {
        parent::__construct();
        $this->userid = 0;
        $this->phone = "";
        $this->mobile = "";
        $this->skillid = 0;
        $this->xp = 0;
        $this->image = "";
        $this->jobrole = "";
        $this->table = "arcdesk_profile";
        $this->map = ["id" => "id", "userid" => "userid", "phone" => "phone", "modile" => "modile",
            "skillid" => "skillid", "xp" => "xp", "image" => "image", "jobrole" => "jobrole"];
        $this->columns = ["id", "userid", "phone", "mobile", "skillid", "xp", "image", "jobrole"];
    }
    
}
