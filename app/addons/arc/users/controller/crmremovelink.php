<?php

if (system\Helper::arcIsAjaxRequest()) {
    $link = CRMUserLink::getByID($_POST["id"]);
    $link->delete();
    system\Helper::arcAddMessage("success", "Link deleted");
    system\Helper::arcReturnJSON();
}