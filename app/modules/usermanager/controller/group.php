<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $group = new UserGroup();
    $group->getByID($_POST["id"]);
    echo json_encode(["name" => $group->name, "description" => $group->description]);
}