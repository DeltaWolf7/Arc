<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $setting = SystemSetting::getByKey("ARC_FILE_UPLOAD_SIZE_BYTES");
    $setting->value = $_POST["limit"];
    $setting->update();
    
    system\Helper::arcAddMessage("success", "Upload limit setting saved.");
}