<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "getQuestions") {
        $multistages = Multistage::getMultistages();
        $data = "<table class=\"table table-striped\">";
        $data .= "<tr><th>ID</th><th>Question</th><th class=\"text-right\"><button class=\"btn btn-default btn-xs\" onclick=\"editQuestion(0)\"><i class=\"fa fa-plus\"></i> New Question</button></th></tr>";
        foreach ($multistages as $multistage) {
            $data .= "<tr><td>" . $multistage->id . "</td><td>" . $multistage->masterquestion . "</td><td class=\"text-right\">"
                    . "<div class=\"btn-group\" role=\"group\">"
                    . "<button class=\"btn btn-default btn-xs\" onclick=\"results(" . $multistage->id . ");\"><i class=\"fa fa-area-chart\"></i> Results</button>"
                    . "<button class=\"btn btn-default btn-xs\" onclick=\"editQuestion(" . $multistage->id . ");\"><i class=\"fa fa-pencil\"></i> Edit</button>"
                    . "<button class=\"btn btn-default btn-xs\" onclick=\"deleteQuestion(" . $multistage->id . ");\"><i class=\"fa fa-close\"></i> Delete</button>"
                    . "</div></td></tr>";
        }
        $data .= "</table>";
        echo json_encode(["html" => $data]);
    } elseif ($_POST["action"] == "deleteQuestion") {
        $multistage = new Multistage();
        $multistage->delete($_POST["id"]);
        system\Helper::arcAddMessage("success", "Question deleted");
    } elseif ($_POST["action"] == "editQuestion") {
        $multistage = new Multistage();
        $multistage->getByID($_POST["id"]);
        echo json_encode(["masterQuestion" => html_entity_decode($multistage->masterquestion), "question1" => html_entity_decode($multistage->question1),
            "question2" => html_entity_decode($multistage->question2), "question3" => html_entity_decode($multistage->question3),
            "question4" => html_entity_decode($multistage->question4), "question5" => html_entity_decode($multistage->question5),
            "answer1" => $multistage->answer1, "answer2" => $multistage->answer2, "answer3" => $multistage->answer3,
            "answer4" => $multistage->answer4, "answer5" => $multistage->answer5]);
    } elseif ($_POST["action"] == "saveQuestion") {
        $multistage = new Multistage();
        $multistage->getByID($_POST["id"]);
        $multistage->masterquestion = html_entity_decode($_POST["masterquestion"]);
        
        if (empty($multistage->masterquestion)) {
            system\Helper::arcAddMessage("danger", "Question must have a master question.");
            return;
        }
        
        $multistage->question1 = html_entity_decode($_POST["question1"]);
        
        if (empty($multistage->question1)) {
            system\Helper::arcAddMessage("danger", "Question 1 must have a question.");
            return;
        }
        
        $multistage->question2 = html_entity_decode($_POST["question2"]);
        
        if (empty($multistage->question2)) {
            system\Helper::arcAddMessage("danger", "Question 2 must have a question.");
            return;
        }
        
        $multistage->question3 = html_entity_decode($_POST["question3"]);
        
        if (empty($multistage->question3)) {
            system\Helper::arcAddMessage("danger", "Question 3 must have a question.");
            return;
        }
        
        $multistage->question4 = html_entity_decode($_POST["question4"]);
        
        if (empty($multistage->question4)) {
            system\Helper::arcAddMessage("danger", "Question 4 must have a question.");
            return;
        }
        
        $multistage->question5 = html_entity_decode($_POST["question5"]);
        
        if (empty($multistage->question5)) {
            system\Helper::arcAddMessage("danger", "Question 5 must have a question.");
            return;
        }
        
        $multistage->answer1 = $_POST["answer1"];
        
        if (empty($multistage->answer1)) {
            system\Helper::arcAddMessage("danger", "Answer 1 has no answer.");
            return;
        }
        
        $multistage->answer2 = $_POST["answer2"];
        
        if (empty($multistage->answer2)) {
            system\Helper::arcAddMessage("danger", "Answer 2 has no answer.");
            return;
        }
        
        $multistage->answer3 = $_POST["answer3"];
        
        if (empty($multistage->answer3)) {
            system\Helper::arcAddMessage("danger", "Answer 3 has no answer.");
            return;
        }
        
        $multistage->answer4 = $_POST["answer4"];
        
        if (empty($multistage->answer4)) {
            system\Helper::arcAddMessage("danger", "Answer 4 has no answer.");
            return;
        }
        
        $multistage->answer5 = $_POST["answer5"];
        
        if (empty($multistage->answer5)) {
            system\Helper::arcAddMessage("danger", "Answer 5 has no answer.");
            return;
        }
        
        $multistage->update();
        system\Helper::arcAddMessage("success", "Question saved");
    }
}