<?php

class OddOneOutResult extends DataProvider {
    
    public $words;
    public $answer;
    public $start;
    public $taken;
    public $userid;
    
    public function __construct() {
        parent::__construct();
        $this->answer = "";
        $this->words = 0;
        $this->start = date("y-m-d h:i:s");
        $this->taken = 0;
        $this->userid = 0;
        $this->table = "erudio_oddoneoutresults";
        $this->columns = ["id", "userid", "start", "answer", "taken", "words"];
    }
}
