<?php

class Address extends DataProvider {

    public $userid;
    public $address1;
    public $address2;
    public $city;
    public $county;
    public $country;
    public $postcode;

    public function __construct() {
        parent::__construct();
        $this->userid = 0;
        $this->address1 = "";
        $this->address2 = "";
        $this->city = "";
        $this->postcode = "";
        $this->county = "";
        $this->country = "";
        $this->table = "arc_store_addresses";
        $this->columns = ["id", "userid", "address1", "address2", "city", "county", "country", "postcode"];
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
                            "city" => $query,
                            "postcode" => $query
                        ]
                    ],
        ]);
    }
}
