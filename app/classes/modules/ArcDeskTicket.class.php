<?php

class ArcDeskTicket extends DataProvider {

    public $created;
    public $reference;
    public $subject;
    public $description;
    public $requesterid;
    public $due;
    public $priorityid;
    public $statusid;
    public $source;
    public $type;
    public $groupid;
    public $agentid;
    public $categoryid;
    public $tags;
    public $companyid;

    public function __construct() {
        parent::__construct();
        $this->created = date("y-m-d H:i:s");
        $this->referenece = "";
        $this->subject = "";
        $this->description = "";
        $this->requesterid = 0;
        $this->due = "";
        $this->priorityid = 0;
        $this->source = "";
        $this->type = "Incident";
        $this->groupid = 0;
        $this->agentid = 0;
        $this->categoryid = 0;
        $this->tags = "";
        $this->statusid = 0;
        $this->companyid = 0;
        $this->table = "arcdesk_tickets";
        $this->columns = ["id", "created", "reference", "subject", "desciprtion", "requesterid", "due", "priorityid", "source", "type", "groupid", "agentid", "categoryid", "tags", "statusid", "companyid"];
    }

    public static function getByStatus($statusid) {
        $tickets = new ArcDeskTicket();
        return $tickets->getCollection(["statusid" => $statusid]);
    }

    public static function getByReference($reference) {
        $tickets = new ArcDeskTicket();
        return $tickets->getCollection(["reference" => $reference]);
    }
}
