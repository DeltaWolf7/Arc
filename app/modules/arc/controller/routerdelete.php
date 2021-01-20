<?php

if (system\Helper::arcIsAjaxRequest()) {
    $permission = Router::getByID($_POST["id"]);
    $permission->delete();
    system\Helper::arcAddMessage("success", "Route deleted");
    system\Helper::arcReturnJSON();
}