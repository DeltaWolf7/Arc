<?php

if (system\Helper::arcIsAjaxRequest()) {
    
    $task = new TMTask();
    $task->getByID($_POST["id"]);
    
    $task->description = html_entity_decode($_POST["description"]);
    $task->due = $_POST["due"];
    $task->owner = $_POST["owner"];
    if ($task->status != "Done" && $_POST["status"] == "Done") {
        $task->donedate = date("y-m-d H:i:s");
    }
    
    $task->status = $_POST["status"];
    $task->tags = $_POST["tags"];
    $task->hours = $_POST["hours"];
    
    $task->update();
    
    system\Helper::arcAddMessage("success", "Task saved");
}