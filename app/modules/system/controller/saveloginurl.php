<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $setting = SystemSetting::getByKey("ARC_LOGIN_URL");
    $setting->value = $_POST["url"];
    $setting->update();
    
    system\Helper::arcAddMessage("success", "Login URL settings saved.");
}