<?php

if (system\helper::arcIsAjaxRequest()) {
    include system\Helper::arcGetModuleControllerPath("taskmaster", "sharedFunctions", true);
    $tasks = TMTask::getAll();
    system\Helper::arcReturnJSON(["html" => getTasksHtml($tasks)]);
}