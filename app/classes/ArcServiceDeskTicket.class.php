<?php

class ArcServiceDeskTicket extends DataProvider {

    public $userid;
    public $summary;
    public $status;
    public $created;
    public $assignedto;
    public $description;
    public $labels;

    public function __construct() {
        parent::__construct();
        $this->userid = 0;
        $this->summary = "";
        $this->status = "Opened";
        $this->created = date("y-m-d H:i:s");
        $this->assignedto = 0;
        $this->description = "";
        $this->labels = "";
        $this->table = ARCDBPREFIX . "servicedesk_tickets";
        $this->map = ["id" => "id", "userid" => "userid", "summary" => "summary", "status" => "status",
             "created" => "created", "assignedto" => "assignedto", "description" => "description",
             "labels" => "labels"];
    }

    public static function getByID($id) {
        $ticket = new ArcServiceDeskTicket();
        $ticket->get(["id" => $id, "LIMIT" => 1]);
        return $ticket;
    }

    public static function getCountTotal($userid = 0) {
        $ticket = new ArcServiceDeskTicket();
        if ($userid == 0)
            return $ticket->getCount([]);
        else
            return $ticket->getCount(["userid" => $userid]);
    }

    public static function getCountByStatus($status) {
        $ticket = new ArcServiceDeskTicket();
        return $ticket->getCount(["status" => $status]);
    }

    public static function search($query, $orderby = "created", $direction = "ASC") {
        $tickets = new ArcServiceDeskTicket();
        return $tickets->getCollection(["OR" => ["summary[~]" => $query, "description[~]" => $query], "ORDER" => ["{$orderby}" => "{$direction}"]]);
    }

    public static function getAllByStatus($status, $userid = 0) {
        $tickets = new ArcServiceDeskTicket();
        if ($userid == 0)
            return $tickets->getCollection(["Status" => $status, "ORDER" => "created"]);
        else
            return $tickets->getCollection(["AND" => ["Status" => $status, "userid" => $userid], "ORDER" => "created"]);
    }

    public static function getAllByOpen($userid = 0) {
        $tickets = new ArcServiceDeskTicket();
        if ($userid == 0)
            return $tickets->getCollection(["status" => ["Opened", "In Progress", "Waiting Support", "Waiting Reporter"], "ORDER" => "created"]);
        else
            return $tickets->getCollection(["AND" => ["status" => ["Opened", "In Progress", "Waiting Support", "Waiting Reporter"], "userid" => $userid], "ORDER" => "created"]); 
    }

    public static function getAll() {
        $tickets = new ArcServiceDeskTicket();
        return $tickets->getCollection([]);
    }

    public static function getStatuses() {
        return ["Opened", "In Progress", "Waiting Support", "Waiting Reporter", "Closed"];
    }
}