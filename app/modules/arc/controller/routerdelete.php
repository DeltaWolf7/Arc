<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $permission = new Router();
    $permission->delete($_POST["id"]);
    system\Helper::arcAddMessage("success", "Route deleted");
}