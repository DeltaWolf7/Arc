<?php

class Sentence {

    public $id = -1;
    public $sentence;
    private $database;

    public function __construct() {
        $this->sentence = '';
        $this->database = new medoo();
    }

    public function updateSentence() {
        if ($this->id == -1) {
            $this->id = $this->database->insert('sentences', [
                'sentence' => $this->sentence]);
        } else {
            $this->database->update('sentences', [
                'sentence' => $this->sentence], ['id' => $this->id]);
        }
    }

    public function deleteSentence($id) {
        $this->database->delete('sentences', ['id' => $id]);
    }

    public function getRandomSentence()
    {
        $data = $this->database->query("SELECT * FROM sentences ORDER BY RAND() LIMIT 0, 1")->fetchAll();
        
         foreach ($data as $sentence) {
   
            $this->id = $sentence['id'];
            $this->sentence = $sentence['sentence'];
            break;
        }
    }
}

?>
