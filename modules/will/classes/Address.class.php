<?php

class Address extends DataProvider {

    public $userid;
    public $clientid;
    public $address1;
    public $address2;
    public $address3;
    public $postcode;
    public $pri;

    public function __construct() {
        parent::__construct();
        $this->userid = 0;
        $this->address1 = '';
        $this->address2 = '';
        $this->address3 = '';
        $this->postcode = '';
        $this->clientid = 0;
        $this->pri = false;
        $this->table = "will_addresses";
        $this->columns = ["id", "userid", "clientid", "address1", "address2", "address3", "postcode", "pri"];
    }

    public static function getPrimary($clientid) {
        $address = new Address();
        $address->get(['AND' => ["clientid" => $clientid, "pri" => true]]);
        return $address;
    }

    public static function getAddresses($clientid) {
        $address = new Address();
        return $address->getCollection(["clientid" => $clientid]);
    }

    public static function search($query) {
        $address = new Address();
        return $address->getCollection(["LIKE" =>
                    ["OR" =>
                        ["address1" => $query,
                            "address2" => $query,
                            "address3" => $query,
                            "postcode" => $query
                        ]
                    ],
        ]);
    }

    public function removeDefaults() {
        //arcDatabase()->query("UPDATE addresses SET pri = 0 WHERE clientid = " . $this->clientid)->fetchAll();
    }
}
