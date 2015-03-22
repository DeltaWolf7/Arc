<?php


    class word {

        private $database;
        public $id = -1;
        public $word;
        public $groupid = 0;

        public function __construct() {
            $this->database = new medoo();
        }

    }


