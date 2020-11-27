<?php

class CRMUserAddress extends DataProvider {

    public $addresslines;
    public $city;
    public $county;
    public $postcode;
    public $country;
    public $userid;
    public $isdelivery;
    public $isbilling;

    public function __construct() {
        parent::__construct();
        $this->addresslines = "";
        $this->county = "";
        $this->postcode = "";
        $this->country = "United Kingdom";
        $this->userid = 0;
        $this->isbilling = 0;
        $this->isdelivery = 0;
        $this->table = ARCDBPREFIX . "crmuseraddresses";
        $this->map = ["id" => "id", "addresslines" => "addresslines", "county" => "county", "postcode" => "postcode",
             "country" => "country", "userid" => "userid", "isdelivery" => "isdelivery", "isbilling" => "isbilling"];
    }

    public static function getByID($id) {
        $crm = new CRMUserAddress();
        $crm->get(["id" => $id]);
        return $crm;
    }

    public static function getAllByUserID($id) {
        $crm = new CRMUserAddress();
        return $crm->getCollection(["userid" => $id]);
    }

    public static function getDeliveryByUserID($id) {
        $crm = new CRMUserAddress();
        $crm->get(["userid" => $id, "isdelivery" => 1]);
        return $crm;
    }

    public static function getBillingByUserID($id) {
        $crm = new CRMUserAddress();
        $crm->get(["userid" => $id, "isbilling" => 1]);
        return $crm;
    }

    public static function clearBillingByUserID($userid) {
        $crm = new CRMUserAddress();
        $addresses = $crm->getCollection(["userid" => $userid]);
        foreach ($addresses as $address) {
            if ($address->isbilling == 1) {
                $address->isbilling = 0;
                $address->update();
            }
        }
    }

    public static function clearDeliveryByUserID($userid) {
        $crm = new CRMUserAddress();
        $addresses = $crm->getCollection(["userid" => $userid]);
        foreach ($addresses as $address) {
            if ($address->isdelivery == 1) {
                $address->isdelivery = 0;
                $address->update();
            }
        }
    }
}