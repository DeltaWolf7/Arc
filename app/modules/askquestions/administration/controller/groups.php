<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] == "savequestion") {
        $question = new Question();
        if (!empty($_POST["id"])) {
            $question->getByID($_POST["id"]);
        }
        $question->groupid = $_POST["group"];
        $question->question = htmlentities($_POST["question"]);
        if (empty($question->question)) {
            echo json_encode(["status" => "danger", "data" => "Question must have text"]);
            return;
        }
        $question->answer1 = $_POST["answer1"];
        if (empty($question->answer1)) {
            echo json_encode(["status" => "danger", "data" => "Question must have answer 1"]);
            return;
        }
        $question->answer2 = $_POST["answer2"];
        $question->answer3 = $_POST["answer3"];
        $question->answer4 = $_POST["answer4"];
        $question->answer5 = $_POST["answer5"];
        $question->correctAnswer = $_POST["correct"];
        $question->update();

        echo json_encode(["status" => "success", "data" => "Question saved"]);
    } else if ($_POST["action"] == "savegroup") {
        $group = new Group();
        $group->getByID($_POST["id"]);
        $group->name = $_POST["group"];
        $group->visible = $_POST["visible"];
        if (empty($group->name)) {
            echo json_encode(["status" => "danger", "data" => "Group must have a name"]);
            return;
        }
        $group->txt = $_POST["text"];
        $group->update();
        echo json_encode(["status" => "success", "data" => "Group created"]);
    } elseif ($_POST["action"] == "deletegroup") {
        $group = new Group();
        $group->delete($_POST["id"]);
        echo json_encode(["status" => "success", "data" => "Group deleted"]);
    } elseif ($_POST["action"] == "getgroups") {
        $groups = Group::getGroups();
        $data = "<table class=\"table table-striped\">";
        $data .= "<tr><th>Question Group</th><th>&nbsp;</th></tr>";
        foreach ($groups as $group) {
            $data .= "<tr><td><a class=\"btn btn-default btn-sm\" onclick=\"getQuestions(" . $group->id . ");\">" . $group->name . "</a></td><td class=\"text-right\"><a class=\"btn btn-default btn-sm\" onclick=\"viewResults(" . $group->id . ");\"><span class=\"fa fa-area-chart\"></span> Results</a> <a class=\"btn btn-default btn-sm\" onclick=\"editGroup(" . $group->id . ");\"><span class=\"fa fa-pencil\"></span> Edit</a> <a class=\"btn btn-default btn-sm\" onclick=\"deleteGroup(" . $group->id . ");\"><span class=\"fa fa-remove\"></span> Delete</a></td></tr>";
        }
        $data .= "</table>";
        echo json_encode(["html" => $data]);
    } elseif ($_POST["action"] == "getquestions") {
        $groups = new Group();
        $questions = $groups->getQuestions($_POST["id"]);
        $data = "<table class=\"table table-striped\">";
        $data .= "<tr><th>Question</th><th class=\"text-right\"><a class=\"btn btn-default btn-sm\" onclick=\"getData();\"><span class=\"fa fa-backward\"></span> Back to Groups</a> <a class=\"btn btn-default btn-sm\" onclick=\"getQuestion(0);\"><span class=\"fa fa-plus\"></span> New Question</a></th></tr>";
        foreach ($questions as $question) {
            $data .= "<tr><td><a class=\"btn btn-default btn-sm\" onclick=\"getQuestion(" . $question->id . ")\">" . $question->question . "</a></td><td class=\"text-right\"><a class=\"btn btn-default btn-sm\" onclick=\"deleteQuestion(" . $question->id . ");\"><span class=\"fa fa-remove\"></span> Delete</a></td></tr>";
        }
        $data .= "</table>";
        echo json_encode(["html" => $data]);
    } elseif ($_POST["action"] == "getquestion") {
        $question = new Question();
        $question->getByID($_POST["id"]);
        if ($question->groupid == 0) {
            $question->groupid = $_POST["group"];
        }

        $data = "<label for=\"group\">Group</label>";
        $data .= "<select class=\"form-control\" id=\"groupS\">";

        $groups = Group::getGroups();
        foreach ($groups as $group) {
            $data .= "<option value=\"" . $group->id . "\"";
            if ($question->groupid == $group->id) {
                $data .= " selected";
            }
            $data .= ">" . $group->name . "</option>";
        }

        $data .= "</select>";

        echo json_encode(["question" => html_entity_decode($question->question), "answer1" => $question->answer1,
            "answer2" => $question->answer2, "answer2" => $question->answer2, "answer3" => $question->answer3,
            "answer4" => $question->answer4, "answer5" => $question->answer5, "correct" => $question->correctAnswer, "group" => $data]);
    } elseif ($_POST["action"] == "getgroup") {
        $group = new Group();
        $group->getByID($_POST["id"]);
        echo json_encode(["name" => $group->name, "txt" => $group->txt, "visible" => $group->visible]);
    } elseif ($_POST["action"] == "deletequestion") {
        $question = new Question();
        $question->delete($_POST["id"]);
        echo json_encode(["status" => "success", "data" => "Question deleted"]);
    }
}