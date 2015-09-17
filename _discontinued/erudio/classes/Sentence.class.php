<?php

class Sentence extends DataProvider {

    public $sentence;

    public function __construct() {
        parent::__construct();
        $this->sentence = "";
        $this->table = "erudio_sentences";
        $this->columns = ["id", "sentence"];
    }

    public static function getRandomSentence() {
        $sentence = new Sentence();
        $data = $sentence->getCollection([]);
        $rnd = rand(0, count($data) - 1);
        return $data[$rnd];
    }

}
