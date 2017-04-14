<?php

if (system\Helper::arcIsAjaxRequest()) {
    $group = UserGroup::getByID($_POST["id"]);
    system\Helper::arcReturnJSON(["name" => $group->name, "description" => $group->description]);
}