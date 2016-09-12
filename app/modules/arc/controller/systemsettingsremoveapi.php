<?php

if (system\Helper::arcIsAjaxRequest()) {
    $apikey = SystemSetting::getByKey("APIKEY", $_POST["userid"]);
    $apikey->delete($apikey->id);
    
    //system\Helper::arcAddMessage("success", "User API key removed");
}