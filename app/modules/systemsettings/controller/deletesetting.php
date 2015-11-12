<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $setting = new SystemSetting();
    $setting->delete($_POST["key"]);
    Log::createLog("info", "settings", "Setting deleted: " . $_POST["key"]);
    system\Helper::arcAddMessage("success", "Setting deleted");
}