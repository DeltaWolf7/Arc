<?php

if (system\Helper::arcIsAjaxRequest()) {
    $group = new UserGroup();
    $group->getByID($_POST["id"]);
    system\Helper::arcReturnJSON(["name" => $group->name, "description" => $group->description]);
}