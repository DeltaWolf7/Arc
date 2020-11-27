<?php

if (system\Helper::arcIsAjaxRequest()) {
    
    $link = new CRMUserLink();
    $link->userid = $_POST["userid"];
    $link->linkedid = $_POST["linkid"];
    $link->update();

    system\Helper::arcAddMessage("success", "Link added");
    system\Helper::arcReturnJSON();
}