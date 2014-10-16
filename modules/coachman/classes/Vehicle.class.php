<?php

class Vehicle extends DataProvider {
    
    public $regno;
    public $seats;
    public $typeid;
    public $fuelcostpermile;
    
    public function __construct() {
        parent::__construct();
        $this->regno = "";
        $this->fuelcostpermile = 0.0;
        $this->seats = 0;
        $this->typeid = 0;
        $this->table = "coachman_vehicles";
        $this->columns = ["id", "regno", "seats", "typeid", "fuelcostpermile"];
    }
    
    public static function getAll() {
        $vehicles = new Vehicle();
        return $vehicles->getCollection(["ORDER" => "regno ASC"]);
    }
}

