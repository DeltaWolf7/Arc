<?php

class TMTask extends DataProvider {
    
    public $created;
    public $due;
    public $owner;
    public $description;
    public $tags;
    
    public function __construct() {
        parent::__construct();
        $this->created = date("y-m-d H:i:s");
        $this->due = "";
        $this->owner = 0;
        $this->description = "";
        $this->tags = "New";
        $this->table = "tm_tasks";
        $this->columns = ["id", "created", "due", "owner", "description", "tags"];
    }
    
    public static function getAll() {
        $task = new TMTask();
        return $task->getCollection(["ORDER" => "id ASC"]);
    }
}
