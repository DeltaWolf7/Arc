<?php

if (system\Helper::arcIsAjaxRequest()) {
    $setting = SystemSetting::getByKey("ARC_MAIL");
    $setting->value = "{\"smtp\":\"{$_POST["smtp"]}\", \"server\":\"{$_POST["server"]}\""
        . ", \"username\":\"{$_POST["username"]}\", \"password\":\"{$_POST["password"]}\","
        . " \"port\":\"{$_POST["port"]}\", \"sender\":\"{$_POST["sender"]}\"}";
    $setting->update();
    
    system\Helper::arcAddMessage("success", "SMTP settings saved.");
}