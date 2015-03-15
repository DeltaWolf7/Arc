<?php

    class Quickfire extends DataProvider {

        public $question;
        public $solution;
        public $image;

        public function __construct() {
            parent::__construct();
            $this->solution = "";
            $this->question = "";
            $this->image = "";
            $this->table = "erudio_quickfire";
            $this->columns = ["id", "question", "solution", "image"];
        }

        public static function getRandom() {
            $quickfire = new Quickfire();
            $data = $quickfire->getCollection([]);
            shuffle($data);
            return $data[0];
        }

    }
