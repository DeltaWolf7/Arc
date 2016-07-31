<?php

if (system\Helper::arcIsAjaxRequest()) {
    $group = new UserGroup();
    $group->getByID($_POST["id"]);
    $group->name = ucwords(strtolower($_POST["name"]));
    if (empty($_POST["name"])) {
        system\Helper::arcAddMessage("danger", "Group name cannot be empty");
        return;
    }
    $group->description = $_POST["description"];
    $group->update();
    system\Helper::arcAddMessage("success", "Group saved");
}