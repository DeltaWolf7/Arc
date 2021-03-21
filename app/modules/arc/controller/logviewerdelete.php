<?php

if (system\Helper::arcIsAjaxRequest()) {

    // Arc logs
    $logs = Log::clear();

    //PHP logs
    $path = system\Helper::arcGetPath(true) . ini_get('error_log');
    if (file_exists($path)) {
        @unlink($path);
    }

    system\Helper::arcAddMessage("success", "Logs purged");
    system\Helper::arcReturnJSON();
}