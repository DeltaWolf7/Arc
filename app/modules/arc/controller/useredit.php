<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByID($_POST["id"]);
    $data = "";
    foreach ($user->getGroups() as $group) {
        $data .= "<li class=\"list-group-item\"><button class=\"btn btn-danger btn-sm\" onclick=\"removeFromGroupBtn('{$group->name}')\"><i class=\"fa fa-close\"></i></button> {$group->name}</li>";
    }

    $companies = $user->getCompanies();
    $company = "";
    foreach ($companies as $comp) {
        $company .= "<li class=\"list-group-item\"><button class=\"btn btn-danger btn-sm\" onclick=\"removeCompanyUser({$comp->id})\"><i class=\"fa fa-close\"></i></button> {$comp->name}</li>";
    }


    system\Helper::arcReturnJSON(["firstname" => $user->firstname, "lastname" => $user->lastname,
         "email" => $user->email, "group" => $data, "enabled" => boolval($user->enabled),
          "company" => $company]);
}