<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $result  = new MultistageResult();
    $result->answer1 = $_POST["answer1"];
    $result->answer2 = $_POST["answer2"];
    $result->answer3 = $_POST["answer3"];
    $result->answer4 = $_POST["answer4"];
    $result->answer5 = $_POST["answer5"];
    $result->questionid = $_POST["questionid"];
    $result->taken = time() - $_POST["start"];
    $result->userid = $_POST["userid"];
    $result->update();
    
    $multistage = new Multistage();
    $multistage->getByID($_POST["questionid"]);
    
    $data = "Here's how you did..<br /><table class=\"table\">";
    
    if (strtoupper($multistage->answer1) == strtoupper($result->answer1)) {
        $data .= "<tr><td>Question 1</td><td><i class=\"label label-success\">Correct</i></td></tr>";
    } else {
        $data .= "<tr><td>Question 1</td><td><i class=\"label label-danger\">Incorrect</i></td></tr>";
    }
    
    if (strtoupper($multistage->answer2) == strtoupper($result->answer2)) {
        $data .= "<tr><td>Question 2</td><td><i class=\"label label-success\">Correct</i></td></tr>";
    } else {
        $data .= "<tr><td>Question 2</td><td><i class=\"label label-danger\">Incorrect</i></td></tr>";
    }
    
    if (strtoupper($multistage->answer3) == strtoupper($result->answer3)) {
        $data .= "<tr><td>Question 3</td><td><i class=\"label label-success\">Correct</i></td></tr>";
    } else {
        $data .= "<tr><td>Question 3</td><td><i class=\"label label-danger\">Incorrect</i></td></tr>";
    }
    
    if (strtoupper($multistage->answer4) == strtoupper($result->answer4)) {
        $data .= "<tr><td>Question 4</td><td><i class=\"label label-success\">Correct</i></td></tr>";
    } else {
        $data .= "<tr><td>Question 4</td><td><i class=\"label label-danger\">Incorrect</i></td></tr>";
    }
    
    if (strtoupper($multistage->answer5) == strtoupper($result->answer5)) {
        $data .= "<tr><td>Question 5</td><td><i class=\"label label-success\">Correct</i></td></tr>";
    } else {
        $data .= "<tr><td>Question 5</td><td><i class=\"label label-danger\">Incorrect</i></td></tr>";
    }
    
    $data .= "</table>";

    system\Helper::arcAddMessage("success", $data);
}