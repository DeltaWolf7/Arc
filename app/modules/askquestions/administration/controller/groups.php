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
        $group->text = $_POST["text"];
        $group->update();
        echo json_encode(["status" => "success", "data" => "Group created"]);
    } else if ($_POST["action"] == "editgroup") {
        $group = new Group();
        $group->getByID($_POST["id"]);
        $group->name = $_POST["name"];
        $group->update();
        echo "success|Group saved";
    } elseif ($_POST["action"] == "getdata") {

        $groups = Group::getGroups();
        $col = 0;
        foreach ($groups as $group) {

            $data = "<div class=\"panel-group\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">";
            $data .= "<div class=\"panel panel-default\">";
            $data .= "<div class=\"panel-heading\" role=\"tab\" id=\"heading" . $col . "\">";
            $data .= "<div class=\"row\">";
            $data .= " <div class=\"col-md-7\">";

            $data .= "<h4 class=\"panel-title\">";
            $data .= "<a class=\"collapsed\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse" . $col . "\" aria-expanded=\"false\" aria-controls=\"collapse" . $col . "\">";
            $data .= "$group->name";
            $data .= "</a></h4></div>";

            $data .= "<div class=\"col-md-5 text-right\">";
            $data .= "<p><button class=\"btn btn-primary btn-xs\" onclick=\"createQuestion(0, " . $group->id . ");\"><span class=\"fa fa-plus\"></span> New Question</button>";
            $data .= " <button class=\"btn btn-default btn-xs\" onclick=\"editGroup(" . $group->id . ", " . $group->name . ")\"><span class=\"fa fa-edit\"></span> Rename</button>";
            $data .= " <button class=\"btn btn-danger btn-xs\" onclick=\"deleteGroup(" . $group->id . ", " . $group->name . ")\"><span class=\"fa fa-close\"></span> Delete</button></p>";
            $data .= "<p><button class=\"btn btn-success btn-xs\" onclick=\"getResults(" . $group->id . ")\"><span class=\"fa fa-area-chart\"></span> All Results</button>";
            $data .= " <button class=\"btn btn-warning btn-xs\" onclick=\"\"><span class=\"fa fa-eye\"></span>";
            if ($group->visible == 1) {
                $data .= "Showing";
            } else {
                $data .= "Not Showing";
            }
            $data .= "</button></p>";
            $data .= "</div>";
            $data .= "</div>";
            $data .= "</div>";

            $data .= "<div id=\"collapse" . $col . "\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"heading" . $col . "\">";
            $data .= "<div class=\"panel-body\">";
            $questions = Group::getQuestions($group->id);
            $count = 1;
            $data .= "<ul class=\"list-group\">";
            foreach ($questions as $question) {
                $data .= "<li class=\"list-group-item\">(Q" . $count . ") <a href=\"" . system\Helper::arcGetModulePath() . "question/" . $question->id . "\">" . html_entity_decode($question->question) . "</a></li>";
                $count++;
            }
            $data .= "</ul>";
            $data .= "</div></div></div></div>";
            $col++;
        }
        echo json_encode(["html" => $data]);
    }
}