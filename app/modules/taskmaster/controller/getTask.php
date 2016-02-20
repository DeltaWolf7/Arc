<?php

if (system\Helper::arcIsAjaxRequest()) {
    $task = new TMTask();
    $task->getByID($_POST["id"]);
       
    system\Helper::arcReturnJSON(["created" => $task->created,
        "due" => $task->due, "description" => html_entity_decode($task->description),
        "tags" => $task->tags, "owner" => $task->owner, "status" => $task->status, "hours" => $task->hours]);
}