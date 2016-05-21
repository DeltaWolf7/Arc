<?php

if (system\Helper::arcIsAjaxRequest()) {
    $html = "<div class=\"row\">"
            . "<div class=\"col-md-1\"><strong>Type</strong></div>"
            . "<div class=\"col-md-1\"><strong>Module</strong></div>"
            . "<div class=\"col-md-2\"><strong>When</strong></div>"
            . "<div class=\"col-md-8\"><strong>Message</strong></div>"
            . "</div>";
    $logs = Log::getLogs();

    foreach ($logs as $log) {
        $html .= "<div class=\"row\">"
                . "<div class=\"col-md-1\">";
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
        $html .= "</div>"
                . "<div class=\"col-md-1\">{$log->module}</div>"
                . "<div class=\"col-md-2\">{$log->when}</div>"
                . "<div class=\"col-md-8\">{$log->message}</div>"
                . "</div>";
    }

    system\Helper::arcReturnJSON(["html" => $html]);
}