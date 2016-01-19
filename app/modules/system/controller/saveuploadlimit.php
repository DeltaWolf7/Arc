<?php

if (system\Helper::arcIsAjaxRequest()) {
    $setting = SystemSetting::getByKey("ARC_FILE_UPLOAD_SIZE_BYTES");
    $setting->value = $_POST["limit"];
    $setting->update();
    
    system\Helper::arcAddMessage("success", "Upload limit setting saved.");
}