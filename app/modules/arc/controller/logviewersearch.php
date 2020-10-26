<?php

if (system\Helper::arcIsAjaxRequest()) {

    $html = "<div class=\"table-responsive\"><table class=\"table table-striped table-sm\">"
            . "<thead class=\"thead-default\"><tr><th>Type</th>"
            . "<th>Module</th>"
            . "<th>When</th>"
            . "<th>Message</th></tr></thead><tbody>";

    $logs = Log::search($_POST["query"]);

    foreach ($logs as $log) {
        $html .= "<tr>"
                . "<td>";
        switch ($log->type) {
            case "success":
                $html .= "<span class=\"badge badge-success\"><i class=\"fa fa-check\"></i><span>";
                break;
            case "info":
                $html .= "<span class=\"badge badge-info\"><i class=\"fa fa-info-circle\"></i><span>";
                break;
            case "danger":
                $html .= "<span class=\"badge badge-danger\"><i class=\"fa fa-exclamation-circle\"></i><span>";
                break;
            case "warning":
                $html .= "<span class=\"badge badge-warning\"><i class=\"fa fa-exclamation-triangle\"></i><span>";
                break;
        }
        $html .= "</td>"
                . "<td class=\"text-sm\">{$log->module}</td>"
                . "<td class=\"text-sm\" style=\"width: 150px;\">" . system\Helper::arcConvertDateTime($log->event) . "</td>"
                . "<td class=\"text-sm\">{$log->message}</td>"
                . "</tr>";
    }
    $html .= "</tbody></table></div>";

    system\Helper::arcReturnJSON(["html" => $html]);
}