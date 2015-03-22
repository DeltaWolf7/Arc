<?php

class MultistageResult extends DataProvider {
    
    public $questionid;
    public $answer1;
    public $answer2;
    public $answer3;
    public $answer4;
    public $answer5;
    public $start;
    public $taken;
    public $userid;
    
    public function __construct() {
        parent::__construct();
        $this->answer1 = "";
        $this->answer2 = "";
        $this->answer3 = "";
        $this->answer4 = "";
        $this->answer5 = "";
        $this->questionid = 0;
        $this->start = date("y-m-d h:i:s");
        $this->taken = 0;
        $this->userid = 0;
        $this->table = "erudio_multistageresults";
        $this->columns = ["id", "questionid", "userid", "start", "answer1", "answer2", "answer3", "answer4", "answer5", "taken"];
    }
}
