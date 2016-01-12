<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $setting = SystemSetting::getByKey($_POST["key"], $_POST["userid"]);
    $setting->delete($setting->id);
    Log::createLog("info", "settings", "Setting deleted: " . $_POST["key"]);
    system\Helper::arcAddMessage("success", "Setting deleted");
}