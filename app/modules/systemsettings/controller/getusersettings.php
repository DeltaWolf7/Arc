<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $table = "<thead><tr><th>Key</th><th>Value</th><th>Group</th><th>&nbsp;</th></tr></tbody><tbody>";
    $settings = SystemSetting::getAll($_POST["userid"]);
    $group = "";
    foreach ($settings as $setting) {
        if ($setting->group != $group && !empty($group)) {
            $table .= "<tr><td colspan=\"4\"><hr /></td></tr>";
        }
        $group = $setting->group;
        $table .= "<tr><td>{$setting->key}</td><td>";
        if (strlen($setting->value) > 80) {
            $table .= substr($setting->value, 0, 79) . "...";
        } else {
            $table .= $setting->value;
        }
        $table .= "</td><td>{$setting->group}</td>"
                . "<td class=\"text-right\"><div class=\"btn-group\" role=\"group\"><a class=\"btn btn-success btn-xs\" onclick=\"editSetting('{$setting->key}');\"><i class=\"fa fa-pencil\"></i></a>"
                . "<a class=\"btn btn-danger btn-xs\" onclick=\"deleteSetting('{$setting->key}');\"><i class=\"fa fa-remove\"></i></a></div></td></tr>";
    }
    $table .= "</tbody>";
    system\Helper::arcReturnJSON(["html" => $table]);
}
