<?php

class TMTask extends DataProvider {

    public $created;
    public $due;
    public $owner;
    public $description;
    public $tags;
    public $status;
    public $donedate;
    public $hours;

    public function __construct() {
        parent::__construct();
        $this->created = date("y-m-d H:i:s");
        $this->due = "0000-00-00 00:00:00";
        $this->owner = 0;
        $this->description = "";
        $this->tags = "";
        $this->status = "New";
        $this->donedate = "0000-00-00 00:00:00";
        $this->hours = 0;
        $this->table = "tm_tasks";
        $this->columns = ["id", "created", "due", "owner", "description", "tags", "status", "donedate", "hours"];
    }

    public static function getAll() {
        $task = new TMTask();
        return $task->getCollection(["ORDER" => "created ASC"]);
    }

    public static function getAllByUserID($id, $status = "New") {
        $task = new TMTask();
        if ($status == "All") {
            return $task->getCollection(["owner" => $id, "ORDER" => "created ASC"]);
        }
        return $task->getCollection(["AND" => ["owner" => $id, "status" => $status], "ORDER" => "created ASC"]);
    }
    
    public static function getAllByStatus($status = "New") {
        $task = new TMTask();
        return $task->getCollection(["status" => $status, "ORDER" => "created ASC"]);
    }

    public static function search($search) {
        $task = new TMTask();
        return $task->getCollection(["OR" => ["description[~]" => $search, "tags[~]" => $search, "id[~]" => $search], "ORDER" => "created ASC"]);
    }
}
