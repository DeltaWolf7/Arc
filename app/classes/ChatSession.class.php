<?php

class ChatSession extends DataProvider {

    public $agentids;
    public $guestid;
    public $event;
    public $status;

    public function __construct() {
        parent::__construct();
        $this->event = date("y-m-d H:i:s");
        $this->agentids = "[]";
        $this->guestid = 0;
        $this->status = "Active";
        $this->table = ARCDBPREFIX . "chat_sessions";
        $this->columns = ["id", "agentids", "guestid", "event", "status"];
        $this->map = ["id" => "id", "agentids" => "agentids",
             "guestid" => "guestid", "event" => "event", "status" => "status"];
    }

    public static function getByID($id) {
        $session = new ChatSession();
        $session->get(["id" => $id]);
        return $session;
    }

    public function getItems()
    {
        $items = new ChatEntry();
        return $items->getCollection(["ORDER" => "event", "sessionid" => $this->id]);
    }

    public static function getSessionsByStatus($status = "Active")
    {
        $session = new ChatSession();
        return $session->getCollection(["ORDER" => "id", "status" => $status]);
    }

    public function getAgents() {
        return json_decode($this->agentids);
    }

     public function addAgent($id) {
        $groups = json_decode($this->agentids);
        foreach ($groups as $group) {
            if ($group == $id) {
                return;
            }
        }
        $groups[] = $id;
        $this->agentids = json_encode($groups);
        $this->update();
    }

    public function removeAgent($id) {
        $groups = json_decode($this->agentids);
        $newGroups = [];
        for ($i = 0; $i < count($agentids); $i++) {
            if ($groups[$i] != $id) {
                $newGroups[] = $groups[$i];
            }
        }
        $this->agentids = json_encode($newGroups);
        $this->update();
    } 

}