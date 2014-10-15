<?php

class quickfire {

    public $id = -1;
    public $question;
    public $solution;
    public $image;
    private $database;

    public function __construct() {
        $this->solution = '';
        $this->question = '';
        $this->database = new medoo();
    }

    public function updateQuickfire() {
        if ($this->id == -1) {
            $this->id = $this->database->query("INSERT INTO quickfire (question, image, solution) " .
                    "VALUES ('" . $this->question . "','" . $this->image . "','" . $this->solution . "')")->fetchAll();
        } else {
            $this->database->query("UPDATE quickfire SET " .
                    "solution='" . $this->solution . "',"
                    . "image='" . $this->image . "',"
                    . "question='" . $this->question . "'"
                    . " WHERE ID=" . $this->id);
        }
    }

    public function deleteQuickfire($id) {
        $this->database->delete('quickfire', ['id' => $id]);
    }

    public function getRandomQuickfire()
    {
         $data = $this->database->query("SELECT * FROM quickfire ORDER BY RAND() LIMIT 0, 1")->fetchAll();
        
         foreach ($data as $quickfire) {
   
            $this->id = $quickfire['id'];
            $this->question = $quickfire['question'];
            $this->solution = $quickfire['solution'];
            $this->image = $quickfire['image'];
            break;
        }
    }
    
    public function getQuickfire($id) {
        $data = $this->database->query("SELECT * FROM quickfire WHERE id=" . $id)->fetchAll();
        
         foreach ($data as $quickfire) {
   
            $this->id = $quickfire['id'];
            $this->question = $quickfire['question'];
            $this->solution = $quickfire['solution'];
            $this->image = $quickfire['image'];
            break;
        }
    }
}
?>