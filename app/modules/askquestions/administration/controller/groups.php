<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] == "savequestion") {

        $question = new Question();
        if (!empty($_POST["questionid"])) {
            $question->getByID($_POST["questionid"]);
        }
        $question->groupid = $_POST["group"];
        $question->question = htmlentities($_POST["question"]);

        $xml = new SimpleXMLElement("<answers></answers>");
        $count = 1;
        while ($count <= 5) {
            if (isset($_POST["answer" . $count])) {
                $xmlItem = $xml->addChild("answer");
                $xmlItem->addAttribute("text", $_POST["answer" . $count]);
                if ($_POST["answer"] == $count) {
                    $xml .= " correct=\"true\"";
                    $xmlItem->addAttribute("correct", "true");
                }
            }
            $count++;
        }
        $question->answer = $xml->asXML();
        $question->update();

        echo "success|Question saved";
    } else if ($_POST["action"] == "savegroup") {
        $group = new Group();
        $group->name = $_POST["group"];
        $group->txt = $_POST["text"];
        $group->update();
        echo json_encode(["status" => "success", "data" => "Group created"]);
    } else if ($_POST["action"] == "editgroup") {
        $group = new Group();
        $group->getByID($_POST["id"]);
        $group->name = $_POST["name"];
        $group->update();
        echo "success|Group saved";
    } elseif ($_POST["action"] == "getgroups") {
        $groups = Group::getGroups();
        $data = "<table class=\"table table-striped\">";
        $data .= "<tr><th>Question Group</th><th>&nbsp;</th></tr>";
        foreach ($groups as $group) {
            $data .= "<tr><td><a class=\"btn btn-default btn-xs\" onclick=\"getQuestions(" . $group->id . ");\">" . $group->name . "</a></td><td class=\"text-right\">{buttons}</td></tr>";
        }
        $data .= "</table>";
        echo json_encode(["html" => $data]);
    } elseif ($_POST["action"] == "getquestions") {
        $groups = new Group();
        $questions = $groups->getQuestions($_POST["id"]);
        $data = "<table class=\"table table-striped\">";
        $data .= "<tr><th>Question</th><th>&nbsp;</th></tr>";
        foreach ($questions as $question) {
            $data .= "<tr><td><a class=\"btn btn-default btn-xs\" onclick=\"getQuestion(" . $question->id . ")\">" . $question->question . "</a></td><td class=\"text-right\">{buttons}</td></tr>";
        }
        $data .= "</table>";
        echo json_encode(["html" => $data]);
    }
}