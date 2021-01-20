<?php

if (system\Helper::arcIsAjaxRequest()) {

    $page = 0;
    $number = 50;
    $count = Log::count();
    $noPages = round($count / $number, 0);
    if (isset($_POST["page"])) {
        $page = $_POST["page"];
    }

    $html = "<div class=\"table-responsive\"><table class=\"table table-striped table-sm\">"
            . "<thead class=\"thead-default\"><tr><th scope=\"col\">Type</th>"
            . "<th scope=\"col\">Module</th>"
            . "<th scope=\"col\">When</th>"
            . "<th scope=\"col\">User</th>"
            . "<th scope=\"col\">Imp</th>"
            . "<th scope=\"col\">Message</th></tr></thead><tbody>";

    $logs = Log::getLogs($page, $number);

    foreach ($logs as $log) {
        $html .= "<tr>"
                . "<td>";
        switch ($log->type) {
            case "success":
                $html .= "<span class=\"badge badge-success\"><em class=\"fa fa-check\"></em><span>";
                break;
            case "info":
                $html .= "<span class=\"badge badge-info\"><em class=\"fa fa-info-circle\"></em><span>";
                break;
            case "danger":
                $html .= "<span class=\"badge badge-danger\"><em class=\"fa fa-exclamation-circle\"></em><span>";
                break;
            case "warning":
                $html .= "<span class=\"badge badge-warning\"><em class=\"fa fa-exclamation-triangle\"></em><span>";
                break;
        }
        $html .= "</td>"
                . "<td class=\"text-sm\">{$log->module}</td>"
                . "<td class=\"text-sm\" style=\"width: 150px;\">" . system\Helper::arcConvertDateTime($log->event) . "</td>";

        if ($log->userid == 0) {
            $html .= "<td class=\"text-sm\">Guest</td>";
        } else {
            $user = User::getByID($log->userid);
            $html .= "<td class=\"text-sm\">" . $user->getFullname() . "</td>";
        }

        if ($log->impersonate == 1) {
            $html .= "<td class=\"text-sm\"><i class=\"fa fa-check text-success\"></i></td>";
        } else {
            $html .= "<td class=\"text-sm\"><i class=\"fa fa-times text-danger\"></i></td>";
        }

        $html .= "<td class=\"text-sm\">{$log->message}</td>"
                . "</tr>";
    }
    $html .= "</tbody></table></div>";

    $html .= "<nav aria-label=\"Navigation\">"
            . "<ul class=\"pagination justify-content-center\">";

    $prevPage = $page - 1;
    $nextPage = $page + 1;

    if ($page == 0) {
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