<?php

class ArcDeskCompany extends DataProvider {
    
    public $name;
    public $members;
    public $contacts;
    
    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->members = "[]";
        $this->contacts = "[]";
        $this->table = "arcdesk_companies";
        $this->columns = ["id", "name", "members", "contacts"];
    }
    
    public static function getByName($name) {
        $company = new ArcDeskCompany();
        $company->get(["name" => $name]);
        return $company;
    }
}
