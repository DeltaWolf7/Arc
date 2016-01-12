<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $setting = SystemSetting::getByKey($_POST["key"], $_POST["userid"]);
    system\Helper::arcReturnJSON(["skey" => $setting->key, "svalue" => $setting->value]);
}