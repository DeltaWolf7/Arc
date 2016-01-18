<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $setting = SystemSetting::getByKey("ARC_THUMB_WIDTH");
    $setting->value = $_POST["width"];
    $setting->update();
    
    system\Helper::arcAddMessage("success", "Thumb width settings saved.");
}