<?php

if (system\Helper::arcIsAjaxRequest() == true) {
       
    $result = new OddOneOutResult();
    $result->taken = time() - $_POST["start"];
    $result->userid = $_POST["userid"];
    $result->words = $_POST["words"];
    
    $data = explode("|", $_POST["words"]);
    $answer = $data[count($data) - 1];
    $result->answer = $_POST["btn"];
    $result->update();
    
    if ($result->answer == $answer) {
        system\Helper::arcAddMessage("success", "You got it correct.");
    } else {
        system\Helper::arcAddMessage("danger", "Sorry, that was incorrect. The odd one out is '" . $answer . "'.");
    }  
}