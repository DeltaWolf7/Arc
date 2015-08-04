<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    
    $result = new ShuffledResult();
    $result->taken = time() - $_POST["start"];
    $result->userid = $_POST["userid"];
    
    $words = explode(" ", $_POST["words"]);
    $result->answer = $words[$_POST["btn"]];
    $result->questionid = $_POST["questionid"];
      
    $result->update();    
    
    $sentence = new Sentence(); 
    $sentence->getByID($_POST["questionid"]);
    $data = explode(" ", $sentence->sentence);
    $correctAnswer = $data[count($data) - 1];

    if ($result->answer == $correctAnswer) {
        system\Helper::arcAddMessage("success", "You got it correct.");
    } else {
        system\Helper::arcAddMessage("danger", "Sorry, that was incorrect. The superfluous word is '" . $correctAnswer . "'.");
    }
}