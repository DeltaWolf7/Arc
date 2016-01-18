<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $html = "<tr><th>Type</th><th>Module</th><th>When</th><th>Message</th></tr>";
    $logs = Log::getLogs();

    foreach ($logs as $log) {
        $html .= "<tr><td>";
        switch ($log->type) {
            case "success":
                $html .= "<span class=\"label label-success\"><i class=\"fa fa-check\"></i> Success<span>";
                break;
            case "info":
                $html .= "<span class=\"label label-info\"><i class=\"fa fa-info-circle\"></i> Info<span>";
                break;
            case "danger":
                $html .= "<span class=\"label label-danger\"><i class=\"fa fa-exclamation-circle\"></i> Error<span>";
                break;
            case "warning":
                $html .= "<span class=\"label label-warning\"><i class=\"fa fa-exclamation-triangle\"></i> Warning<span>";
                break;
        }
        $html .= "</td><td>{$log->module}</td><td>{$log->when}</td><td>{$log->message}</td></tr>";
    }
    system\Helper::arcReturnJSON(["html" => $html]);
}