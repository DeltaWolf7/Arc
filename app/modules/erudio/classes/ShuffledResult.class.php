<?php

class ShuffledResult extends DataProvider {
    
    public $questionid;
    public $answer;
    public $start;
    public $taken;
    public $userid;
    
    public function __construct() {
        parent::__construct();
        $this->answer = "";
        $this->questionid = 0;
        $this->start = date("y-m-d h:i:s");
        $this->taken = 0;
        $this->userid = 0;
        $this->table = "erudio_shuffledresults";
        $this->columns = ["id", "questionid", "answer", "start", "taken", "userid"];
    }
    
    public static function getByQuestionID($id) {
        $multi = new ShuffledResult();
        return $multi->getCollection(["questionid" => $id]);
    }
}
