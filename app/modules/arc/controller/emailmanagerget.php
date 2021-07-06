<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $table = "<thead class=\"text-primary\"><tr><th>Key</th><th>Subject</th><th>System</th><th class=\"text-end\"><button onclick=\"editPage(0);\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-plus\"></i> Create</button></th></tr></thead>";
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

        $table .= "<td class=\"text-end\"><button class=\"btn btn-info btn-sm\" onclick=\"send({$email->id});\"><i class=\"far fa-paper-plane\"></i></button>"
                . " <button class=\"btn btn-success btn-sm\" onclick=\"editPage({$email->id});\"><i class='fa fa-pencil'></i></button>"
                . " <button onclick=\"removePage({$email->id});\" class=\"btn btn-danger btn-sm\"><i class='fa fa-remove'></i></button></td>"
                . "</tr>";
    }
    $table .= "</tbody>";
    system\Helper::arcReturnJSON(["html" => $table]);
}