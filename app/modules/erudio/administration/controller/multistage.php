<?php

if (system\Helper::arcIsAjaxRequest() == true) {

    if ($_POST["action"] == "getQuestions") {
        $multistages = Multistage::getMultistages();
        $data = "<table class=\"table table-striped\">";
        $data .= "<tr><th>ID</th><th>Question</th><th class=\"text-right\"><button class=\"btn btn-default btn-xs\" onclick=\"newQuestion\"><i class=\"fa fa-plus\"></i> New Question</button></th></tr>";
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
    }
}