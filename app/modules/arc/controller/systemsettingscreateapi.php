<?php

if (system\Helper::arcIsAjaxRequest()) {
    
    $apikey = SystemSetting::getByKey("APIKEY", $_POST["userid"]);
    if ($apikey->id == 0) {
        $apikey->value = system\Helper::arcCreatePassword(24);;
        $apikey->update();
    }

    //system\Helper::arcAddMessage("success", "User API key created");
    system\Helper::arcReturnJSON();
}