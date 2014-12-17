<?php

if (arcGetURLData("data2") == null) {
    include arcGetModulePath(true) . "view/default.php";
} elseif (arcGetURLData("data2") == "visible") {
    $group = new Group();
    $group->getByID(arcGetURLData("data3"));
    if ($group->visible == 1) {
        $group->visible = false;
    } else {
        $group->visible = true;
    }
    $group->update();
    include arcGetModulePath(true) . "view/default.php";
} elseif (arcGetURLData("data2") == "delete") {
    $question = new Question();
    $question->delete(arcGetURLData("data3"));
    include arcGetModulePath(true) . "view/default.php";
} elseif (arcGetURLData("data2") == "deletegroup") {
    $group = new Group();
    $group->delete(arcGetURLData("data3"));
    $questions = Group::getQuestions(arcGetURLData("data3"));
    foreach ($questions as $question) {
        $question->delete($question->id);
    }
    include arcGetModulePath(true) . "view/default.php";
} else {
    include arcGetModulePath(true) . "view/" . arcGetURLData("data2") . ".php";
}
?>