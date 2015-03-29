<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "getQuestions") {
        $multistages = Multistage::getMultistages();
        $data = "<table class=\"table table-striped\">";
        $data .= "<tr><th>ID</th><th>Question</th><th class=\"text-right\"><button class=\"btn btn-default btn-xs\" onclick=\"genQuestions()\"><i class=\"fa fa-cog\"></i> Question Builder</button> <button class=\"btn btn-default btn-xs\" onclick=\"editQuestion(0)\"><i class=\"fa fa-plus\"></i> New Question</button></th></tr>";
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
        echo utf8_encode(json_encode(["masterQuestion" => html_entity_decode($multistage->masterquestion), "question1" => html_entity_decode($multistage->question1),
            "question2" => html_entity_decode($multistage->question2), "question3" => html_entity_decode($multistage->question3),
            "question4" => html_entity_decode($multistage->question4), "question5" => html_entity_decode($multistage->question5),
            "answer1" => $multistage->answer1, "answer2" => $multistage->answer2, "answer3" => $multistage->answer3,
            "answer4" => $multistage->answer4, "answer5" => $multistage->answer5]));
    } elseif ($_POST["action"] == "saveQuestion") {
        $multistage = new Multistage();
        if ($_POST["id"] != 0) {
            $multistage->getByID($_POST["id"]);
        }
        $multistage->masterquestion = htmlentities($_POST["masterquestion"]);

        if (empty($multistage->masterquestion)) {
            system\Helper::arcAddMessage("danger", "Question must have a master question.");
            return;
        }

        $multistage->question1 = htmlentities($_POST["question1"]);

        if (empty($multistage->question1)) {
            system\Helper::arcAddMessage("danger", "Question 1 must have a question.");
            return;
        }

        $multistage->question2 = htmlentities($_POST["question2"]);

        if (empty($multistage->question2)) {
            system\Helper::arcAddMessage("danger", "Question 2 must have a question.");
            return;
        }

        $multistage->question3 = htmlentities($_POST["question3"]);

        if (empty($multistage->question3)) {
            system\Helper::arcAddMessage("danger", "Question 3 must have a question.");
            return;
        }

        $multistage->question4 = htmlentities($_POST["question4"]);

        if (empty($multistage->question4)) {
            system\Helper::arcAddMessage("danger", "Question 4 must have a question.");
            return;
        }

        $multistage->question5 = htmlentities($_POST["question5"]);

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
    } elseif ($_POST["action"] == "getresults") {
        $results = MultistageResult::getByQuestionID($_POST["id"]);
        if (count($results) == 0) {
            echo json_encode(["data" => "No results for this question group recorded."]);
            return;
        }

        // question table
        $data = "<h2>Question</h2>";
        $data .= "<table class=\"table table-hover table-condensed\">";
        $question = new Multistage();
        $question->getByID($_POST["id"]);
        $data .= "<tr><td><strong>Master Question</strong></td><td>{$question->masterquestion}</td><td></td></tr>";
        $data .= "<tr><td><strong>Question 1</strong></td><td>{$question->question1}</td><td>{$question->answer1}</td></tr>";
        $data .= "<tr><td><strong>Question 2</strong></td><td>{$question->question2}</td><td>{$question->answer2}</td></tr>";
        $data .= "<tr><td><strong>Question 3</strong></td><td>{$question->question3}</td><td>{$question->answer3}</td></tr>";
        $data .= "<tr><td><strong>Question 4</strong></td><td>{$question->question4}</td><td>{$question->answer4}</td></tr>";
        $data .= "<tr><td><strong>Question 5</strong></td><td>{$question->question5}</td><td>{$question->answer5}</td></tr>";
        $data .= "</table>";

        $data .= "<h2>Results</h2>";
        $data .= "<table class=\"table table-hover table-condensed\">";
        foreach ($results as $result) {
            $user = new User();
            $user->getByID($result->userid);
            $data .= "<tr><td><strong>Student: </strong>{$user->getFullname()} ({$result->start})</td><td><strong>Taken: </strong>{$result->taken}</td></tr>";
            $data .= "<tr><td>Question 1</td><td><label class=\"label ";
            if (strtolower($result->answer1) == strtolower($question->answer1)) {
                $data .= "label-success";
            } else {
                $data .= "label-danger";
            }
            $data .= "\">{$result->answer1}</label></td></tr>";
            $data .= "<tr><td>Question 2</td><td><label class=\"label ";
            if (strtolower($result->answer2) == strtolower($question->answer2)) {
                $data .= "label-success";
            } else {
                $data .= "label-danger";
            }
            $data .= "\">{$result->answer2}</label></td></tr>";
            $data .= "<tr><td>Question 3</td><td><label class=\"label ";
            if (strtolower($result->answer3) == strtolower($question->answer3)) {
                $data .= "label-success";
            } else {
                $data .= "label-danger";
            }
            $data .= "\">{$result->answer3}</label></td></tr>";
            $data .= "<tr><td>Question 4</td><td><label class=\"label ";
            if (strtolower($result->answer4) == strtolower($question->answer4)) {
                $data .= "label-success";
            } else {
                $data .= "label-danger";
            }
            $data .= "\">{$result->answer4}</label></td></tr>";
            $data .= "<tr><td>Question 5</td><td><label class=\"label ";
            if (strtolower($result->answer5) == strtolower($question->answer5)) {
                $data .= "label-success";
            } else {
                $data .= "label-danger";
            }
            $data .= "\">{$result->answer5}</label></td></tr>";
        }
        $data .= "</table>";
        echo utf8_encode(json_encode(["data" => $data]));
    }
}