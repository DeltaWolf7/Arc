<?php

if (system\Helper::arcIsAjaxRequest()) {
    $html = "<table class=\"table table-striped table-sm\">"
            . "<thead class=\"thead-default\"><tr><th>Type</th>"
            . "<th>Module</th>"
            . "<th>When</th>"
            . "<th>Message</th></tr></thead><tbody>";

    $logs = Log::getLogs();

    foreach ($logs as $log) {
        $html .= "<tr>"
                . "<td>";
        switch ($log->type) {
            case "success":
                $html .= "<span class=\"badge badge-success\"><i class=\"fa fa-check\"></i> Success<span>";
                break;
            case "info":
                $html .= "<span class=\"badge badge-info\"><i class=\"fa fa-info-circle\"></i> Info<span>";
                break;
            case "danger":
                $html .= "<span class=\"badge badge-danger\"><i class=\"fa fa-exclamation-circle\"></i> Error<span>";
                break;
            case "warning":
                $html .= "<span class=\"badge badge-warning\"><i class=\"fa fa-exclamation-triangle\"></i> Warning<span>";
                break;
        }
        $html .= "</td>"
                . "<td>{$log->module}</td>"
                . "<td>" . system\Helper::arcConvertDateTime($log->event) . "</td>"
                . "<td>{$log->message}</td>"
                . "</tr>";
    }
    $html .= "</tbody></table>";

    system\Helper::arcReturnJSON(["html" => $html]);
}