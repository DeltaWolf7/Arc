<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $logs = Log::getLogs();
    foreach ($logs as $log) {
        $log->delete($log->id);
    }
}