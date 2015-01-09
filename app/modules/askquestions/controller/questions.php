<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] == "saveresult") {
        $result = Result::getByGroupAndUserIDAndQuestionID($_POST["grpid"], $_POST["id"], $_POST["qid"]);
        $no = $_POST["question"] + 1;
        if (count($result) == 0) {
            if ($_POST["answer"] == "0") {
                echo json_encode(["status" => "warning", "data" => "Question skipped"]);
            } else {
                $result = new Result();
                $result->groupid = $_POST["grpid"];
                $result->userid = $_POST["id"];
                $result->questionid = $_POST["qid"];
                $time = $_POST["time"];
                $result->timetaken = time() - $time;
                $result->resultno = $_POST["answer"];
                $result->questionno = $no;
                $result->update();
                echo json_encode(["status" => "success", "data" => "Answer saved"]);
            }
        } else {
            echo json_encode(["status" => "warning", "data" => "Question already answered."]);
        }
    } elseif ($_POST["action"] == "getQuestions") {
        $table = "<tr><th>Complete</th><th>Question Group</th><th>&nbsp;</th></tr>";
        $groups = Group::getGroups();
        foreach ($groups as $group) {
            if ($group->visible == 1) {
                $result = Result::getByGroupAndUserID($group->id, system\Helper::arcGetUser()->id);
                $questions = Group::getQuestions($group->id);
                $table .= "<tr><td>";
                $table .= count($result) . "/" . count($questions);
                $table .= "</td>";
                $table .= "<td><a href=\"#\" onclick=\"getGroup({$group->id});\">{$group->name}</a></td>";
                $table .= "<td class=\"text-right\"><button class=\"btn btn-default btn-xs\" onclick=\"getResult(" . $group->id . ");\"><i class=\"fa fa-area-chart\"></i> View My Results</button></td>";
                $table .= "</tr>";
            }
        }
        echo utf8_encode(json_encode(["html" => $table]));
    } elseif ($_POST["action"] == "getGroup") {
        $done = false;
        $questions = Group::getQuestions($_POST["id"]);
        $group = new Group();
        $group->getByID($_POST["id"]);
        $time = time();
        $data = "";
        $questionno = $_POST["question"] + 1;
        if (count($questions) >= $questionno) {
            if (!empty($group->txt)) {
                $data .= "<strong>Group Text</strong><div class=\"well\">" . $group->txt . "</div>";
            }

            $question = $questions[$_POST["question"]];
            $data .= "<div class=\"form-group\">";
            $data .= "<strong>Question " . $questionno . " of " . count($questions) . "</strong>";
            $data .= "<div class=\"well\">" . html_entity_decode($question->question) . "</div>";
            $data .= "<div class=\"form-group\">";
            $data .= "<select class=\"form-control\" id=\"answer\">";
            $data .= "<option value='0'>Not Answered</option>";

            if ($question->answer1 != "") {
                $data .= "<option value='1'>" . html_entity_decode($question->answer1) . "</option>";
            }
            if ($question->answer2 != "") {
                $data .= "<option value='2'>" . html_entity_decode($question->answer2) . "</option>";
            }
            if ($question->answer3 != "") {
                $data .= "<option value='3'>" . html_entity_decode($question->answer3) . "</option>";
            }
            if ($question->answer4 != "") {
                $data .= "<option value='4'>" . html_entity_decode($question->answer4) . "</option>";
            }
            if ($question->answer5 != "") {
                $data .= "<option value='5'>" . html_entity_decode($question->answer5) . "</option>";
            }

            $data .= "</select>";
            $data .= "</div>";
            $data .= "</div>";
        } else {
            $data = "No more questions remaining.";
            $done = true;
        }

        echo utf8_encode(json_encode(["time" => $time, "html" => $data, "done" => $done, "questionid" => $question->id]));
    } elseif ($_POST["action"] == "getresults") {
        $results = Result::getByGroupAndUserID($_POST["grpid"], $_POST["id"]);
        if (count($results) == 0) {
            echo json_encode(["html" => "No results for this question group recorded."]);
            return;
        }
        $questions = Group::getQuestions($results[0]->groupid);
        $totalTime = 0;
        $correct = 0;
        $table = "<table class=\"table table-striped\">";
        $table .= "<tr><th style=\"width: 50px;\"></th><th>Question</th><th>Answer</th><th>Your Answer</th><th>Correct</th><th>Time (sec)</th></tr>";
        foreach ($questions as $question) {
            foreach ($results as $result) {
                if ($result->questionid == $question->id) {
                    $table .= "<tr><td>" . $result->questionno . "</td><td>" . html_entity_decode($question->question) . "</td><td>";
                    switch ($question->correctAnswer) {
                        case 1:
                            $table .= html_entity_decode($question->answer1);
                            break;
                        case 2:
                            $table .= html_entity_decode($question->answer2);
                            break;
                        case 3:
                            $table .= html_entity_decode($question->answer3);
                            break;
                        case 4:
                            $table .= html_entity_decode($question->answer4);
                            break;
                        case 5:
                            $table .= html_entity_decode($question->answer5);
                            break;
                    }
                    $table .= "</td><td>";
                    switch ($result->resultno) {
                        case 1:
                            $table .= html_entity_decode($question->answer1);
                            break;
                        case 2:
                            $table .= html_entity_decode($question->answer2);
                            break;
                        case 3:
                            $table .= html_entity_decode($question->answer3);
                            break;
                        case 4:
                            $table .= html_entity_decode($question->answer4);
                            break;
                        case 5:
                            $table .= html_entity_decode($question->answer5);
                            break;
                    }
                    $table .= "</td><td>";
                    if ($result->resultno == $question->correctAnswer) {
                        $table .= "<div class=\"label label-success\"><i class=\"fa fa-check\"></i></div>";
                        $correct++;
                    } else {
                        $table .= "<div class=\"label label-danger\"><i class=\"fa fa-remove\"></i></div>";
                    }
                    $table .= "</td><td>" . $result->timetaken . "</td></tr>";
                    $totalTime += $result->timetaken;
                }
            }
        }

        $table .= "</table>";
        $table .= "<div class=\"well\">";
        $table .= "Total time taken: ";
        if ($totalTime < 60) {
            $table .= $totalTime . " seconds";
        } else {
            $min = $totalTime / 60;
            $table .= $min . " minutes";
        }
        $table .= "<br />Score: " . $correct . "/" . count($questions);
        $percent = (100 / count($questions)) * $correct;
        $table .= " (" . number_Format($percent, 2) . "%)";
        $table .= "</div>";
        echo utf8_encode(json_encode(["html" => $table]));
    }
}
