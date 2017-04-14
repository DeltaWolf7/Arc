<?php

if (system\Helper::arcIsAjaxRequest()) {
    $table = "<table class=\"table table-hover table-sm\">"
            . "<thead><tr><th>Name</th><th># Users</th>"
            . "<th class=\"text-right\"><button onclick=\"editCompany(0);\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-plus\"></i> Create</button></th>"
            . "</tr></thead><tbody>";
    $companies = Company::getAll();
    foreach ($companies as $company) {
        $userCount = $company->getUsers();
        
        $table .= "<tr><td>{$company->name}</td>"
                . "<td>" . count($userCount) . "</td>"
                . "<td class=\"text-right\">"
                . "<div class=\"btn-group\" role=\"group\">"
                . "<button onclick=\"editCompany({$company->id});\" class=\"btn btn-success btn-sm\"><i class=\"fa fa-pencil\"></i> Edit</button>"
                . "<button onclick=\"removeCompany({$company->id});\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-remove\"></i> Remove</button>"
                . "</div>"
                . "</td></tr>";
    }
    $table .= "</tbody></table>";
    echo json_encode(["html" => $table]);
}