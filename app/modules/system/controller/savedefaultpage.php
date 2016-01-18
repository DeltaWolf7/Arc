<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $setting = SystemSetting::getByKey("ARC_DEFAULT_PAGE");
    $setting->value = $_POST["url"];
    $setting->update();
    
    system\Helper::arcAddMessage("success", "Default URL settings saved.");
}