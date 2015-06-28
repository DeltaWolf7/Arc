<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "settings") {
        $table = "<thead><tr><th>Key</th><th>Value</th><th>&nbsp;</th></tr></tbody><tbody>";
        $settings = SystemSetting::getAll();
        foreach ($settings as $setting) {
            $table .= "<tr><td>{$setting->key}</td><td>{$setting->value}</td>"
                    . "<td class=\"text-right\"><a class=\"btn btn-default btn-xs\" onclick=\"editSetting('{$setting->key}');\"><i class=\"fa fa-edit\"></i> Edit</a>"
                    . " <a class=\"btn btn-default btn-xs\" onclick=\"deleteSetting('{$setting->key}');\"><i class=\"fa fa-remove\"></i> Delete</a></td></tr>";
        }
        $table .= "</tbody>";
        system\Helper::arcReturnJSON(["html" => $table]);
    } elseif ($_POST["action"] == "editsetting") {
        $setting = SystemSetting::getByKey($_POST["key"]);
        system\Helper::arcReturnJSON(["skey" => $setting->key, "svalue" => $setting->value]);
    } elseif ($_POST["action"] == "savesetting") {
        if (empty($_POST["key"])) {
            system\Helper::arcAddMessage("danger", "Key must be provided");
            return;
        }

        if (strpos($_POST["key"], " ") == true) {
            system\Helper::arcAddMessage("danger", "Key cannot contain spaces");
            return;
        }

        $setting = SystemSetting::getByKey($_POST["key"]);
        if (empty($setting->key)) {
            $setting->key = ucwords($_POST["key"]);
        }
        $setting->value = $_POST["value"];
        $setting->update();
        Log::createLog("info", "settings", "Setting saved: " . $_POST["key"]);
        system\Helper::arcAddMessage("success", "Setting saved");
    } elseif ($_POST["action"] == "deletesetting") {
        $setting = new SystemSetting();
        $setting->delete($_POST["key"]);
        Log::createLog("info", "settings", "Setting deleted: " . $_POST["key"]);
        system\Helper::arcAddMessage("success", "Setting deleted");
    }
}