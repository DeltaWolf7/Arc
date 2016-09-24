<?php

if (system\Helper::arcIsAjaxRequest()) {
    $html = "<table class=\"table table-responsive table-striped\">"
            . "<thead><tr><th>Type</th>"
            . "<th>Module</th>"
            . "<th>When</th>"
            . "<th>Message</th></tr></thead><tbody>";

    $count = Log::count();
    $pageNo = 0;
    if (isset($_POST["page"])) {
        $pageNo = $_POST["page"];
    }
    $noPages = $count / 50;
    $logs = Log::getPagination(50, $pageNo * 50);

    foreach ($logs as $log) {
        $html .= "<tr>"
                . "<td>";
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
        $html .= "</td>"
                . "<td>{$log->module}</td>"
                . "<td>" . system\Helper::arcConvertDateTime($log->event) . "</td>"
                . "<td>{$log->message}</td>"
                . "</tr>";
    }
    $html .= "</tbody></table>";

    $html .= "<nav aria-label=\"...\">"
            . "<ul class=\"pager\">";
    if ($pageNo != 0) {
        $lastPage = $pageNo - 1;
        $html .= "<li><a onclick=\"getLogs({$lastPage})\">Previous</a></li>";
    }

    if ($pageNo < $noPages - 1) {
        $nextPage = $pageNo + 1;
        $html .= "<li><a onclick=\"getLogs({$nextPage})\">Next</a></li>";
    }
    $html .= "</ul>"
            . "</nav>";

    system\Helper::arcReturnJSON(["html" => $html]);
}