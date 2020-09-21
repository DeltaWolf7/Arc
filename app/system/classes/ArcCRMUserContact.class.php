<?php

class ArcCRMUserContact extends DataProvider {

    public $name;
    public $title;
    public $email;
    public $phone;
    public $userid;

    public function __construct() {
        parent::__construct();
        $this->name = "";
        $this->title = "";
        $this->email = "";
        $this->phone = "";
        $this->userid = 0;
        $this->table = ARCDBPREFIX . "crmusercontacts";
        $this->map = ["id" => "id", "name" => "name", "title" => "title", "email" => "email",
             "phone" => "phone", "userid" => "userid"];
    }

    public static function getByID($id) {
        $crm = new ArcCRMUserContact();
        $crm->get(["id" => $id]);
        return $crm;
    }

    public static function getAllByUserID($id) {
        $crm = new ArcCRMUserContact();
        return $crm->getCollection(["userid" => $id]);
    }

}