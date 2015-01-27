<?php

class Issue extends DataProvider {
    
    public $status;
    public $description;
    public $created;
    public $labels;
    
    public function __construct() {
        parent::__construct();
        $this->status = 0;
        $this->description = "";
        $this->created = date("y-m-d h:i:s");
        $this->labels = "[\"\"]";
        $this->columns = ["id", "status", "description", "created", "labels"];
        $this->table = ARCDBPREFIX . "issues";
    }
    
    public static function getAllIssues() {
        $issues = new Issue();
        return $issues->getCollection(["ORDER" => "created DESC"]);
    }
}
