<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $setting = SystemSetting::getByKey("ARC_KEEP_LOGS");
    $setting->value = $_POST["days"];
    $setting->update();
    
    system\Helper::arcAddMessage("success", "Log settings saved.");
}