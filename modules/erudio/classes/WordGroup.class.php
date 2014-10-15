<?php

class wordgroup {
    
    private $database;
    public $id = -1;
    public $name;
    public $synonymgroup= 0;
    public $antonymgroup= 0;
    public $words;
    
    public function __construct() {
        $this->database = new medoo();
        $this->words = Array();
    }
    
    public function getWords()
    {
        $data = $this->database->select('words', ['id', 'word', 'groupid'],['groupid' => $this->id]);

        foreach ($data as $word) {
            $wrd = new word();
            $wrd->id = $word['id'];
            $wrd->word = $word['word'];
            $wrd->groupid = $word['groupid'];
            array_push($this->words, $wrd);
        }
    }
    
    public function getRandomGroup()
    {
        $data = $this->database->query("SELECT * FROM wordgroups ORDER BY RAND() LIMIT 0, 1")->fetchAll();
        
         foreach ($data as $wordgroup) {
   
            $this->id = $wordgroup['id'];
            $this->name = $wordgroup['name'];
            $this->antonymgroup = $wordgroup['antonymgroup'];
            $this->synonymgroup = $wordgroup['synonymgroup'];
            break;
        }
        
        $this->getWords();
    }
    
    public function getAntonymGroup()
    {
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
    
    public function getSynonymGroup()
    {
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
    
     public function getWordGroups()
    {
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
    
    public function getWordGroupsWithAntonyms()
    {
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
    
    public function getWordGroupsWithSynonyms()
    {
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

?>
