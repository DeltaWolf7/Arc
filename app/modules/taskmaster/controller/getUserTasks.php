<?php

if (system\helper::arcIsAjaxRequest()) {
    include system\Helper::arcGetModuleControllerPath("taskmaster", "sharedFunctions", true);
    $tasks = TMTask::getAllByUserID(system\Helper::arcGetUser()->id, $_POST["status"]);
    system\Helper::arcReturnJSON(["html" => getTasksHtml($tasks)]);
}