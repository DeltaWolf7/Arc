<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $table = "<thead class=\"thead-default\"><tr><th scope=\"col\">Key</th><th scope=\"col\">Subject</th><th scope=\"col\">System</th><th scope=\"col\" class=\"text-right\"><button onclick=\"editPage(0);\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-plus\"></i> Create</button></th></tr></thead>";
    $table .= "<tbody>";
    $emails = Email::getAll();
    foreach ($emails as $email) {
        $table .= "<tr>"
                . "<td>{$email->key}</td>"
                . "<td>{$email->subject}</td>";
        if ($email->protected == 1) {
            $table .= "<td><i class=\"fas fa-check text-success\"></i></td>";
        } else {
            $table .= "<td><i class=\"fas fa-times text-danger\"></i></td>";
        }

        $table .= "<td class=\"text-right\"><div class=\"btn-group\" role=\"group\"><button class=\"btn btn-success btn-sm\" onclick=\"editPage({$email->id});\"><i class='fa fa-pencil'></i> Edit</button>"
                . "&nbsp;<button onclick=\"removePage({$email->id});\" class=\"btn btn-danger btn-sm\"><i class='fa fa-remove'></i> Remove</button></div></td>"
                . "</tr>";
    }
    $table .= "</tbody>";
    system\Helper::arcReturnJSON(["html" => $table]);
}