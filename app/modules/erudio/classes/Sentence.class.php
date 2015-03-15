<?php

    class Sentence extends DataProvider {

        public $sentence;

        public function __construct() {
            $this->sentence = "";
            $this->table = "erudio_sentences";
            $this->columns = ["id", "sentence"];
        }

        public static function getRandomSentence() {
            $data = $this->getCollection("");
            $rnd = rand(0, count($data - 1));
            return $data[$rnd];
        }

    }
