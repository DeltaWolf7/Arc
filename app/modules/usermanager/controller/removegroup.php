<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $group = new UserGroup();
    $group->getByID($_POST["id"]);
    
    if ($group->name == "Administrators" || $group->name == "Guests" || $group->name == "Users") {
        system\Helper::arcAddMessage("danger", "Unable to delete builtin groups");
        return;
    }
    
    $group->delete($_POST["id"]);
    system\Helper::arcAddMessage("success", "Group deleted");
}