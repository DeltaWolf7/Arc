<?php

if (system\helper::arcIsAjaxRequest()) {
    include system\Helper::arcGetModuleControllerPath("taskmaster", "sharedFunctions", true);
    $tasks = TMTask::search($_POST["search"]);
    system\Helper::arcReturnJSON(["html" => getTasksHtml($tasks)]);
}