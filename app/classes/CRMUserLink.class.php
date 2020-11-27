<?php

class CRMUserLink extends DataProvider {

    public $userid;
    public $linkedid;

    public function __construct() {
        parent::__construct();
        $this->linkedid = 0;
        $this->userid = 0;
        $this->table = ARCDBPREFIX . "crmuserlinks";
        $this->map = ["id" => "id", "userid" => "userid", "linkedid" => "linkedid"];
    }

    public static function getByID($id) {
        $crm = new CRMUserLink();
        $crm->get(["id" => $id]);
        return $crm;
    }

    public static function getAllByUserID($id) {
        $crm = new CRMUserLink();
        return $crm->getCollection(["OR" => ["userid" => $id, "linkedid" => $id]]);
    }

}