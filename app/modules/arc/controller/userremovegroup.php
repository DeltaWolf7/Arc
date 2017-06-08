<?php

if (system\Helper::arcIsAjaxRequest()) {
    $group = UserGroup::getByID($_POST["id"]);
    
    if ($group->name == "Administrators" || $group->name == "Guests" || $group->name == "Users") {
        system\Helper::arcAddMessage("danger", "Unable to delete builtin groups");
        system\Helper::arcReturnJSON(["message" => "OK"]);
        return;
    }
    
    $group->delete($_POST["id"]);
    system\Helper::arcAddMessage("success", "Group deleted");
    system\Helper::arcReturnJSON(["message" => "OK"]);
}