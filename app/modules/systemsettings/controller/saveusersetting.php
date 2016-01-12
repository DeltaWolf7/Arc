<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if (empty($_POST["key"])) {
        system\Helper::arcAddMessage("danger", "Key must be provided");
        return;
    }

    if (strpos($_POST["key"], " ") == true) {
        system\Helper::arcAddMessage("danger", "Key cannot contain spaces");
        return;
    }

    $setting = SystemSetting::getByKey($_POST["key"], $_POST["userid"]);
    if (empty($setting->key)) {
        $setting->key = ucwords($_POST["key"]);
    }
    $setting->value = $_POST["value"];
    $setting->update();
    Log::createLog("info", "settings", "Setting saved: " . $_POST["key"]);
    system\Helper::arcAddMessage("success", "Setting saved");
}