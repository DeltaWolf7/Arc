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
        $group->visible = boolval($_POST["visible"]);
        if (empty($group->name)) {
            echo json_encode(["status" => "danger", "data" => "Group must have a name"]);
            return;
        }
        $group->txt = $_POST["text"];
        $group->update();
        echo json_encode(["status" => "success", "data" => "Group saved"]);
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
            $data .= "<tr><td><a class=\"btn btn-default btn-sm\" onclick=\"getQuestion(" . $question->id . ")\">" . html_entity_decode($question->question) . "</a></td><td class=\"text-right\"><a class=\"btn btn-default btn-sm\" onclick=\"copyQuestion(" . $question->id . ");\"><span class=\"fa fa-copy\"></span> Duplicate</a> <a class=\"btn btn-default btn-sm\" onclick=\"deleteQuestion(" . $question->id . ");\"><span class=\"fa fa-remove\"></span> Delete</a></td></tr>";
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
        echo json_encode(["name" => $group->name, "txt" => $group->txt, "visible" => boolval($group->visible)]);
    } elseif ($_POST["action"] == "deletequestion") {
        $question = new Question();
        $question->delete($_POST["id"]);
        echo json_encode(["status" => "success", "data" => "Question deleted"]);
    } elseif ($_POST["action"] == "getresults") {
        $group = UserGroup::getByName("Students");
        $users = $group->getUsers();
        $data = "<table class=\"table table-striped\"><tr><td>Student</td><td>Score</td></tr>";
        $groupCount = Group::getQuestions($_POST["id"]);
        foreach ($users as $user) {
            $results = Result::getByGroupAndUserID($_POST["id"], $user->id);
            if (count($results) > 0) {
                $score = 0;
                $correct = 0;
                $time = 0;
                foreach ($results as $result) {
                    $question = new Question();
                    $question->getByID($result->questionid);
                    if ($result->resultno == $question->correctAnswer) {
                        $correct++;
                    }
                    $time += $result->timetaken;
                }
                $score = (100 / count($groupCount)) * $correct;
                if ($time > 60) {
                    $t = (60 / $time) . " minutes";
                } else {
                    $t = $time + " seconds";
                }
                $data .= "<tr><td><a class=\"btn btn-default\" onclick=\"viewResult(" . $user->id . "," . $_POST["id"] . ")\">" . $user->getFullname() . "</a></td><td>" . $correct . "/" . count($groupCount) . " (" . number_format($score, 2) . "%)<br />Time: " . $t . "</td></tr>";
            }
        }
        $data .= "</table>";
        echo json_encode(["data" => $data]);
    } elseif ($_POST["action"] == "getresult") {
        $results = Result::getByGroupAndUserID($_POST["group"], $_POST["id"]);
        if (count($results) == 0) {
            echo json_encode(["html" => "No results for this question group recorded."]);
            return;
        }
        $questions = Group::getQuestions($results[0]->groupid);
        $count = 0;
        $totalTime = 0;
        $correct = 0;
        $user = new User();
        $user->getByID($_POST["id"]);
        $table = "Student: " . $user->getFullname();
        $table .= "<p class=\"text-right\"><a class=\"btn btn-default btn-sm\" onclick=\"viewResults(" . $_POST["group"] . ");\"><span class=\"fa fa-backward\"></span> Back</a><p>";
        $table .= "<table class=\"table table-striped\">";
        $table .= "<tr><th>Question</th><th>Answer</th><th>Your Answer</th><th>Correct</th><th>Time (sec)</th></tr>";
        foreach ($questions as $question) {
            if (isset($results[$count])) {
                $table .= "<tr><td>" . html_entity_decode($question->question) . "</td><td>";
                switch ($question->correctAnswer) {
                    case 1:
                        $table .= $question->answer1;
                        break;
                    case 2:
                        $table .= $question->answer2;
                        break;
                    case 3:
                        $table .= $question->answer3;
                        break;
                    case 4:
                        $table .= $question->answer4;
                        break;
                    case 5:
                        $table .= $question->answer5;
                        break;
                }
                $table .= "</td><td>";
                switch ($results[$count]->resultno) {
                    case 1:
                        $table .= $question->answer1;
                        break;
                    case 2:
                        $table .= $question->answer2;
                        break;
                    case 3:
                        $table .= $question->answer3;
                        break;
                    case 4:
                        $table .= $question->answer4;
                        break;
                    case 5:
                        $table .= $question->answer5;
                        break;
                }
                $table .= "</td><td>";
                if ($results[$count]->resultno == $question->correctAnswer) {
                    $table .= "<div class=\"label label-success\"><span class=\"fa fa-check\"></span></div>";
                    $correct++;
                } else {
                    $table .= "<div class=\"label label-danger\"><span class=\"fa fa-remove\"></span></div>";
                }
                $table .= "</td><td>" . $results[$count]->timetaken . "</td></tr>";
                $totalTime += $results[$count]->timetaken;
            }
            $count++;
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
        echo json_encode(["data" => $table]);
    } elseif ($_POST["action"] == "copyquestion") {
        $question = new Question();
        
        $oquestion = new Question();
        $oquestion->getByID($_POST["id"]);
        
        $question->answer1 = $oquestion->answer1;
        $question->answer2 = $oquestion->answer2;
        $question->answer3 = $oquestion->answer3;
        $question->answer4 = $oquestion->answer4;
        $question->answer5 = $oquestion->answer5;
        $question->correctAnswer = $oquestion->correctAnswer;
        $question->groupid = $oquestion->groupid;    
        $txt = html_entity_decode($oquestion->question);     
        $question->question = htmlentities("Copy of: " . $txt);
        $question->update();
        echo json_encode(["status"=> "success", "data" => "Question duplicated"]);
    }
}