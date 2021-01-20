<?php

if (system\Helper::arcIsAjaxRequest()) {
    $apikey = SystemSetting::getByKey("APIKEY", $_POST["userid"]);
    $apikey->delete();
    
    system\Helper::arcReturnJSON();
}