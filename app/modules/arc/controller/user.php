<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByID($_POST["id"]);
    $data = "";
    foreach ($user->getGroups() as $group) {
        $data .= "<li class=\"list-group-item\"><a class=\"btn btn-danger btn-xs\" onclick=\"removeFromGroupBtn('{$group->name}')\"><i class=\"fa fa-close\"></i></a> {$group->name}</li>";
    }

    $companies = $user->getCompanies();
    $company = "";
    foreach ($companies as $comp) {
        $company .= "<li class=\"list-group-item\"><a class=\"btn btn-danger btn-xs\" onclick=\"removeCompanyUser({$comp->id})\"><i class=\"fa fa-close\"></i></a> {$comp->name}</li>";
    }


    system\Helper::arcReturnJSON(["firstname" => $user->firstname, "lastname" => $user->lastname, "email" => $user->email, "group" => $data, "enabled" => boolval($user->enabled), "company" => $company]);
}