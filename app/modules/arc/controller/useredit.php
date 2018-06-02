<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByID($_POST["id"]);
    $userGroups = UserGroup::getAllGroups();

    $groups = "<h3>Groups</h3><table class=\"table\">"
        . "<thead><tr class=\"thead-default\">";

    // header
    foreach ($userGroups as $group) { 
        $groups .= "<th>{$group->name}</th>";
    }
        
    $groups .= "</tr></thead>";

    // body
    $groups .= "<tr>";
    foreach ($userGroups as $group) { 
        $groups .= "<td>"
        . "<label class=\"form-check-label\">"
        . "<input type=\"checkbox\" class=\"form-check-input\"";
        
        if ($user->inGroup($group->name)) {
            $groups .= " checked";
        }

        $groups .= " onclick=\"addUserToGroup({$user->id},'{$group->name}')\">"
        . "<span class=\"custom-control-indicator\"></span>"
        . "</label>"
        . "</td>";
    }
    $groups .= "</tr>";

    $groups .= "</table>";

    system\Helper::arcReturnJSON(["firstname" => $user->firstname, "lastname" => $user->lastname,
         "email" => $user->email, "groups" => $groups, "enabled" => $user->enabled]);
}