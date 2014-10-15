<?php

class Multistage extends DataProvider {

    public $masterquestion;
    public $image;
    public $question1;
    public $question2;
    public $question3;
    public $question4;
    public $question5;
    public $answer1;
    public $answer2;
    public $answer3;
    public $answer4;
    public $answer5;

    public function __construct() {
        parent::__construct();
        $this->masterquestion = "";
        $this->image = "";
        $this->question1 = "";
        $this->question2 = "";
        $this->question3 = "";
        $this->question4 = "";
        $this->question5 = "";
        $this->answer1 = "";
        $this->answer2 = "";
        $this->answer3 = "";
        $this->answer4 = "";
        $this->answer5 = "";
        $this->table = "erudio_multistage";
        $this->columns = ["id", "masterquestion", "image",
            "question1", "question2", "question3", "question4", "question5",
            "answer1", "answer2", "answer3", "answer4", "answer5"];
    }

    public static function getRandomMultistage() {
        $multistage = new Multistage();
        $multistage->get(["ORDER" => RAND(), "LIMIT" => 1]);
        return $multistage;
    }
    
    public static function getMultistages() {
        $multistage = new Multistage();
        return $multistage->getCollection([]);
    }
}

?>
