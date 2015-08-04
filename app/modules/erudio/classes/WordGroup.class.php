<?php

class WordGroup extends DataProvider {

    public $name;
    public $synonymgroup;
    public $antonymgroup;

    public function __construct() {
        parent::__construct();
        $this->synonymgroup = 0;
        $this->antonymgroup = 0;
        $this->table = "erudio_wordgroups";
        $this->columns = ["id", "name", "synonymgroup", "antonymgroup"];
    }

    public function getWords() {
        $data = new Word();
        return $data->getCollection(["groupid" => $this->id]);
    }

    public static function getRandomGroup() {
        $data = new WordGroup();
        $collection = $data->getCollection([]);
        return $collection[rand(0, count($collection) - 1)];
    }

    public function getAntonymGroup() {
        $data = $this->database->query("SELECT * FROM wordgroups WHERE id='" . $this->antonymgroup . "' LIMIT 0, 1")->fetchAll();

        $antonym = new wordgroup();
        foreach ($data as $wordgroup) {

            $antonym->id = $wordgroup['id'];
            $antonym->name = $wordgroup['name'];
            $antonym->antonymgroup = $wordgroup['antonymgroup'];
            $antonym->synonymgroup = $wordgroup['synonymgroup'];
            break;
        }

        $antonym->getWords();
        return $antonym;
    }

    public function getSynonymGroup() {
        $data = $this->database->query("SELECT * FROM wordgroups WHERE id='" . $this->synonymgroup . "' LIMIT 0, 1")->fetchAll();

        $synonym = new wordgroup();
        foreach ($data as $wordgroup) {

            $antonym->id = $wordgroup['id'];
            $antonym->name = $wordgroup['name'];
            $antonym->antonymgroup = $wordgroup['antonymgroup'];
            $antonym->synonymgroup = $wordgroup['synonymgroup'];
            break;
        }

        $synonym->getWords();
        return $synonym;
    }

    public function getWordGroups() {
        $data = $this->database->select('wordgroups', ['id', 'name', 'antonymgroup', 'synonymgroup']);

        foreach ($data as $wordgroup) {
            $wrdgrp = new wordgroup();
            $wrdgrp->id = $wordgroup['id'];
            $wrdgrp->name = $wordgroup['name'];
            $wrdgrp->antonymgroup = $wordgroup['antonymgroup'];
            $wrdgrp->synonymgroup = $wordgroup['synonymgroup'];
            array_push($this->wordgroups, $wrdgrp);
        }
    }

    public function getWordGroupsWithAntonyms() {
        $data = $this->database->query("SELECT * FROM wordgroups WHERE antonymgroup <> 0")->fetchAll();

        foreach ($data as $wordgroup) {
            $wrdgrp = new wordgroup();
            $wrdgrp->id = $wordgroup['id'];
            $wrdgrp->name = $wordgroup['name'];
            $wrdgrp->antonymgroup = $wordgroup['antonymgroup'];
            $wrdgrp->synonymgroup = $wordgroup['synonymgroup'];
            array_push($this->wordgroups, $wrdgrp);
        }
    }

    public function getWordGroupsWithSynonyms() {
        $data = $this->database->query("SELECT * FROM wordgroups WHERE synonymgroup <> 0")->fetchAll();

        foreach ($data as $wordgroup) {
            $wrdgrp = new wordgroup();
            $wrdgrp->id = $wordgroup['id'];
            $wrdgrp->name = $wordgroup['name'];
            $wrdgrp->antonymgroup = $wordgroup['antonymgroup'];
            $wrdgrp->synonymgroup = $wordgroup['synonymgroup'];
            array_push($this->wordgroups, $wrdgrp);
        }
    }
}
