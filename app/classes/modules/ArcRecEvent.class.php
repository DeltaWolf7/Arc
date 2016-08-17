<?php

class ArcRecEvent extends DataProvider {
    
    public $roomid;
    public $hosts;
    public $guests;
    public $eventdate;
    
    public function __construct() {
        parent::__construct();
        $this->roomid = 0;
        $this->hosts = "[\"\"]";
        $this->guests = "[\"\"]";
        $this->eventdate = "";
        $this->table = "arcrec_events";
        $this->map = ["id" => "id", "roomid" => "roomid", "hosts" => "hosts", "guests" => "guests",
            "eventdate" => "eventdate"];
        $this->columns = ["id", "roomid", "hosts", "guests", "eventdate"];
    }
    
    public static function getTodaysEvents() {
        $events = new ArcRecEvent();
        return $events->getCollection(["eventdate[~]" => date("Y-m-d")]);
    }
    
    public function getGuests() {
        $guests = json_decode($this->guests, true);
        $collection = array();
        foreach ($guests as $guest) {
            $user = ArcRecGuest::getByID($guest);
            $collection[] = $user;
        }
        return $collection;
    }
}
