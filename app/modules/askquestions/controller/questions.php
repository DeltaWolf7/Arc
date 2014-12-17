<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] == "answerquestion") {

        $count = 1;
        $data = "";
        while (isset($_POST["Q" . $count])) {
            $data .= json_encode(["Q" . $count => $_POST["Q" . $count]]);
            $count++;
        }

        $result = new Result();
        $result->groupid = $_POST["groupid"];
        $result->userid = $_POST["userid"];
        $time = $_POST["time"];
        $result->timetaken = time() - $time;
        $result->result = $data;
        $result->update();

        echo json_encode(["status" => "success", "data" => "Results saved"]);
    } elseif ($_POST["action"] == "getQuestions") {
        $table = "<tr><th>Complete</th><th>Group</th><th>&nbsp;</th></tr>";
        $groups = Group::getGroups();
        foreach ($groups as $group) {
            if ($group->visible == 1) {
                $result = Result::getByGroupAndUserID($group->id, system\Helper::arcGetUser()->id);
                $questions = Group::getQuestions($group->id);
                $table .= "<tr><td>";
                if (count($result) > 0) {
                    $table .= "<span class=\"fa fa-check\"></span>";
                } else {
                    $table .= "<span class=\"fa fa-remove\"></span>";
                }
                $table .= "</td>";
                $table .= "<td><a class=\"btn btn-default btn-sm\" onclick=\"getGroup({$group->id});\">{$group->name}</a></td>";
                $table .= "<td class=\"text-right\"><button class=\"btn btn-success btn-xs\" onclick=\"getResult(" . $group->id . ");\"><span class=\"fa fa-area-chart\"></span> View My Results</button></td>";
                $table .= "</tr>";
            }
        }  
        echo json_encode(["html" => $table]);
    } elseif ($_POST["action"] == "getGroup") {
        $data = "<form>";
        $questions = Group::getQuestions($_POST["id"]);
        $count = 1;
        $time = time();
        foreach ($questions as $question) {
            $data .= "<div class=\"form-group\">";
            $data .= "<strong>Question " . $count . "</strong>";
            $data .= "<div class=\"well\">" . html_entity_decode($question->question) . "</div>";
            $data .= "<div class=\"form-group\">";
            $data .= "<select class=\"form-control\" id=\"Q" . $count ."\">";
            while ($count <= 5) {
                if (!empty($question->answer . $count)) {
                    $data .= "<option value='" . $count . "'>" . $question->answer . $count . "</option>";
                }
                $count++;
            }
            $data .= "</select>";
            $data .= "</div>";
            $data .= "</div>";  
        }
        $data .= "</form>";
        echo json_encode(["time" => "{$time}", "html" => $data]);
    }
}