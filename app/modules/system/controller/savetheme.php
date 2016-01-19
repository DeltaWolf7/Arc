<?php

if (system\Helper::arcIsAjaxRequest()) {
    $setting = SystemSetting::getByKey("ARC_THEME");
    $setting->value = $_POST["theme"];
    $setting->update();
    
    system\Helper::arcAddMessage("success", "Theme settings saved.");
}