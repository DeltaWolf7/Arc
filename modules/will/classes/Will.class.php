<?php

class Will extends DataProvider {

    public $userid;
    public $clientid;
    public $partnerid;
    public $relationship;
    public $exe1;
    public $exe2;
    public $exe3;
    public $exe4;
    public $gua;
    public $gua1;
    public $gua2;
    public $gua3;
    public $gua4;
    public $legacies;
    public $legs;
    public $charchoice;
    public $char;
    public $property;
    public $prop;
    public $res1;
    public $res2;
    public $res3;
    public $res4;
    public $custom;

    public function __construct() {
        parent::__construct();
        $this->userid = 0;
        $this->clientid = 0;
        $this->partnerid = 0;
        $this->relationship = "";
        $this->exe1 = 0;
        $this->exe2 = 0;
        $this->exe3 = 0;
        $this->exe4 = 0;
        $this->gua = "No";
        $this->gua1 = 0;
        $this->gua2 = 0;
        $this->gua3 = 0;
        $this->gua4 = 0;
        $this->legacies = "No";
        $this->legs = "";
        $this->charChoice = "No";
        $this->char = "";
        $this->property = "No";
        $this->prop = "";
        $this->res1 = 0;
        $this->res2 = 0;
        $this->res3 = 0;
        $this->res4 = 0;
        $this->custom = "";
        $this->table = "will_wills";
        $this->columns = ["id", "userid", "clientid", "partnerid", "relationship", "exe1", "exe2", "exe3", "exe4", "gua", "gua1",
            "gua2", "gua3", "gua4", "legacies", "legs", "charchoice", "char", "property", "prop", "res1", "res2", "res3", "res4", "custom"];
    }
    
    public static function getByClientID($clientid) {
        $will = new Will();
        $will->get(["clientid" => $clientid]);
        return $will;
    }
}
