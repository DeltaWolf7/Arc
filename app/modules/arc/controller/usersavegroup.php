<?php

if (system\Helper::arcIsAjaxRequest()) {
    $group = UserGroup::getByID($_POST["groupid"]);
    $group->name = ucwords(strtolower($_POST["groupname"]));
    if (empty($_POST["groupname"])) {
        system\Helper::arcAddMessage("danger", "Group name cannot be empty");
        system\Helper::arcReturnJSON(["error" => true]);
        return;
    }
    $group->description = $_POST["groupdescription"];
    $group->update();
    system\Helper::arcAddMessage("success", "Group saved");
    system\Helper::arcReturnJSON([]);
}