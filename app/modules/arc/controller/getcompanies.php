<?php

if (system\Helper::arcIsAjaxRequest()) {
    $table = "<table class=\"table table-hover table-condensed\">"
            . "<thead><tr><th>Name</th><th># Users</th>"
            . "<th class=\"text-right\"><a onclick=\"editCompany(0);\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-plus\"></i> Create</a></th>"
            . "</tr></thead><tbody>";
    $companies = Company::getAll();
    foreach ($companies as $company) {
        $userCount = $company->getUsers();
        
        $table .= "<tr><td>{$company->name}</td>"
                . "<td>" . count($userCount) . "</td>"
                . "<td class=\"text-right\">"
                . "<div class=\"btn-group\" role=\"group\">"
                . "<a onclick=\"editCompany({$company->id});\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-pencil\"></i> Edit</a>"
                . "<a onclick=\"removeCompany({$company->id});\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-remove\"></i> Remove</a>"
                . "</div>"
                . "</td></tr>";
    }
    $table .= "</tbody></table>";
    echo json_encode(["html" => $table]);
}