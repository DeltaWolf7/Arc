<?php

if (system\Helper::arcIsAjaxRequest()) {
    $task = new TMTask();
    $task->getByID($_POST["id"]);
       
    system\Helper::arcReturnJSON(["created" => $task->created,
        "due" => $task->due, "description" => $task->description,
        "tags" => $task->tags, "owner" => $task->owner]);
}