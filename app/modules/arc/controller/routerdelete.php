<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $permission = Router::getByID($_POST["id"]);
    $permission->delete();
    system\Helper::arcAddMessage("success", "Route deleted");
    system\Helper::arcReturnJSON();
}