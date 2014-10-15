<?php

class Client extends DataProvider {

    public $name;
    public $dob;
    public $sex;
    public $disabled;
    public $phone;
    public $userid;

    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->dob = "";
        $this->userid = 0;
        $this->sex = "";
        $this->disabled = false;
        $this->phone = "";
        $this->table = "will_clients";
        $this->columns = ["id", "userid", "name", "dob", "sex", "disabled", "phone"];
    }

    public static function getClients($userid) {
        $client = new Client();
        return $client->getCollection(["userid" => $userid]);
    }

    public static function search($query) {
        $client = new Client();
        return $client->getCollection(["LIKE" => ["OR" => ["name" => $query, "phone" => $query]]]);     
    }

}
