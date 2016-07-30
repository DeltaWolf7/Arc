<?php

if (system\Helper::arcIsAjaxRequest()) {

    // Arc logs
    $logs = Log::getLogs();
    foreach ($logs as $log) {
        $log->delete($log->id);
    }

    //PHP logs
    $path = system\Helper::arcGetPath(true) . ini_get('error_log');
    if (file_exists($path)) {
        unlink($path);
    }

    system\Helper::arcAddMessage("success", "Logs purged");
}