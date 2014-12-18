<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] == "settings") {
        $table = "<tr><th>Key</th><th>Value</th><th>&nbsp;</th></tr>";
        $settings = SystemSetting::getAll();
        foreach ($settings as $setting) {
            $table .= "<tr><td>" . $setting->key . "</td><td>" . $setting->setting . "</td>"
                    . "<td class=\"text-right\"><a class=\"btn btn-default btn-sm\" onclick=\"editSetting('" . $setting->key . "');\"><span class=\"fa fa-edit\"></span> Edit</a>"
                    . "&nbsp;<a class=\"btn btn-default btn-sm\" onclick=\"deleteSetting('" . $setting->key . "');\"><span class=\"fa fa-remove\"></span> Delete</a></td></tr>";
        }
        echo json_encode(["html" => $table]);
    } elseif ($_POST["action"] == "editsetting") {
        $setting = SystemSetting::getByKey($_POST["key"]);
        echo json_encode(["skey" => $setting->key, "svalue" => $setting->setting]);
    } elseif ($_POST["action"] == "savesetting") {
        if (empty($_POST["key"])) {
            echo json_encode(["status" => "danger", "data" => "Key must be provided"]);
            return;
        }
        
        if (strpos($_POST["key"], " ") == true) {
            echo json_encode(["status" => "danger", "data" => "Key cannot contain spaces."]);
            return;
        }

        $setting = SystemSetting::getByKey($_POST["key"]);
        if (empty($setting->key)) {
            $setting->key = ucwords($_POST["key"]);
        }
        $setting->setting = $_POST["value"];
        $setting->update();

        echo json_encode(["status" => "success", "data" => "Setting saved"]);
    } elseif ($_POST["action"] == "deletesetting") {
        $setting = new SystemSetting();
        $setting->delete($_POST["key"]);

        echo json_encode(["status" => "success", "data" => "Setting deleted"]);
    }
}