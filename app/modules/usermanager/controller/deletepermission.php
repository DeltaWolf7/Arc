<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $permission = new UserPermission();
    $permission->delete($_POST["id"]);
    system\Helper::arcAddMessage("success", "Permission deleted");
}