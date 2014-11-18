<?php

require_once "../../../system/bootstrap.php";

if ($_POST["action"] == "savequestion") {

    $question = new Question();
    if (!empty($_POST["questionid"])) {
        $question->getByID($_POST["questionid"]);
    }
    $question->groupid = $_POST["group"];
    $question->question = $_POST["question"];

    $xml = "<answers>";
    $count = 1;
    while ($count <= 5) {
        if (isset($_POST["answer" . $count])) {
            $xml .= "<answer text=\"" . $_POST["answer" . $count] . "\"";
            if ($_POST["answer"] == $count) {
                $xml .= " correct=\"true\"";
            }
            $xml .= "></answer>";
        }
        $count++;
    }
    $xml .= "</answers>";
    $question->answer = $xml;
    $question->update();

    echo "success|Question saved";
} else if ($_POST["action"] == "savegroup") {
    $group = new Group();
    $group->name = $_POST["name"];
    $group->update();
    echo "success|Group saved";
}
?>

