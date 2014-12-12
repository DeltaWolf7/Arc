<?php

class VehicleType extends DataProvider {
    
    public $name;
    
    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->table = "coachman_vehicletypes";
        $this->columns = ["id", "name"];
    }
    
    public static function getAll() {
        $vehicles = new VehicleType();
        return $vehicles->getCollection(["ORDER" => "name ASC"]);
    }
}

