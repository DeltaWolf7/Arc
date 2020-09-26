<?php

class CRMUser extends DataProvider {

    public $company;
    public $source;
    public $addresslines;
    public $city;
    public $county;
    public $postcode;
    public $country;
    public $phone;
    public $notes;
    public $userid;

    public function __construct() {
        parent::__construct();
        $this->company = "";
        $this->source = "Direct";
        $this->addresslines = "";
        $this->county = "";
        $this->postcode = "";
        $this->country = "United Kingdom";
        $this->phone = "";
        $this->notes = "";
        $this->userid = 0;
        $this->table = ARCDBPREFIX . "crmusers";
        $this->map = ["id" => "id", "company" => "company", "source" => "source", "addresslines" => "addresslines",
             "county" => "county", "postcode" => "postcode", "country" => "country", "phone" => "phone", "notes" => "notes", "userid" => "userid"];
    }

    public static function getByID($id) {
        $crm = new CRMUser();
        $crm->get(["id" => $id]);
        return $crm;
    }

    public static function getByUserID($id) {
        $crm = new CRMUser();
        $crm->get(["userid" => $id]);
        return $crm;
    }

}