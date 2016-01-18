<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $setting = SystemSetting::getByKey("ARC_THEME");
    $setting->value = $_POST["theme"];
    $setting->update();
    
    system\Helper::arcAddMessage("success", "Theme settings saved.");
}