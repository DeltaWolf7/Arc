<?php

class Word extends DataProvider {

    public $word;
    public $groupid;

    public function __construct() {
        parent::__construct();
        $this->word = "";
        $this->groupid = 0;
        $this->table = "erudio_words";
        $this->columns = ["id", "word", "groupid"];
    }
}
