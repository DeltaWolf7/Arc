<?php

if (system\Helper::arcIsAjaxRequest()) {

    $page = 1;
    $number = 50;
    $count = Log::count();
    $noPages = round($count / $number, 0);
    if (isset($_POST["page"])) {
        $page = $_POST["page"];
    }

    $html = "<div class=\"table-responsive\"><table class=\"table table-striped table-sm\">"
            . "<thead class=\"thead-default\"><tr><th>Type</th>"
            . "<th>Module</th>"
            . "<th>When</th>"
            . "<th>Message</th></tr></thead><tbody>";

    $logs = Log::getLogs($page, $number);

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
    $html .= "</tbody></table></div>";

    $html .= "<nav aria-label=\"Navigation\">"
            . "<ul class=\"pagination justify-content-center\">";

    $prevPage = $page - 1;
    $nextPage = $page + 1;

    if ($page == 1) {
        $html .= "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">Previous</a></li>";
    } else {
        $html .= "<li class=\"page-item\"><a class=\"page-link\" href=\"#\" onclick=\"getItem(" . $prevPage . ")\">Previous</a></li>";
    }

    $html .= "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">" . $page . "</a></li>"
        . "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">of</a></li>"
        . "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">" . $noPages . "</a></li>";

    if ($page == $noPages) {
        $html .= "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">Next</a></li>";
    } else {
        $html .= "<li class=\"page-item\"><a class=\"page-link\" href=\"#\" onclick=\"getItem(" . $nextPage . ")\">Next</a></li>";
    }
    $html .= "</ul>"
            . "</nav>";

    system\Helper::arcReturnJSON(["html" => $html]);
}