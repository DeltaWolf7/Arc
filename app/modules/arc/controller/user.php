<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByID($_POST["id"]);
    $data = "<label for=\"groups2\">In Groups</label><select id=\"groups2\" class=\"form-control\" size=\"16\">";
    foreach ($user->getGroups() as $group) {
        $data .= "<option value=\"{$group->name}\">{$group->name}</option>";
    }
    $data .= "</select>";
    
    $comp = Company::getByUser($user->id);
    $company = "";
    if ($comp != null) {
        $company = $comp->name;
    }
    
    system\Helper::arcReturnJSON(["firstname" => $user->firstname, "lastname" => $user->lastname, "email" => $user->email, "group" => $data, "enabled" => boolval($user->enabled), "company" => $company]);
}