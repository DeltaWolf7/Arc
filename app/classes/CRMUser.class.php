<?php

class CRMUser extends DataProvider {

    public $company;
    public $source;
    public $phone;
    public $notes;
    public $userid;

    public function __construct() {
        parent::__construct();
        $this->company = "";
        $this->source = "Direct";
        $this->phone = "";
        $this->notes = "";
        $this->userid = 0;
        $this->table = ARCDBPREFIX . "crmusers";
        $this->map = ["id" => "id", "company" => "company", "source" => "source", "phone" => "phone", "notes" => "notes", "userid" => "userid"];
    }

    public static function getByID($id) {
        $crm = new CRMUser();
        $crm->get(["id" => $id, "LIMIT" => 1]);
        return $crm;
    }

    public static function getByUserID($id) {
        $crm = new CRMUser();
        $crm->get(["userid" => $id, "LIMIT" => 1]);
        return $crm;
    }

    public static function getByUserIDAndCreate($id) {
        $crm = new CRMUser();
        $crm->get(["userid" => $id, "LIMIT" => 1]);
        if ($crm->id == 0 && $id > 0) {
            $crm = new CRMUser();
            $crm->userid = $id;
            $crm->update();
        }
        return $crm;
    }

    public function delete() {
        $crmcontacts = CRMUserContact::getAllByUserID($this->userid);
        foreach ($crmcontacts as $contact) {
            $contact->delete();
        }
        $crmlinks = CRMUserLink::getAllByUserID($this->userid);
        foreach ($crmlinks as $link) {
            $link->delete();
        }
        $crmaddresses = CRMUserAddress::getAllByUserID($this->userid);
        foreach ($crmaddresses as $address) {
            $address->delete();
        }

        parent::delete();
    }

}