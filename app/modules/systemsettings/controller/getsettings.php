<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $table = "<thead><tr><th>Key</th><th>Value</th><th>Group</th><th>&nbsp;</th></tr></tbody><tbody>";
    $settings = SystemSetting::getAll();
    $group = "";
    foreach ($settings as $setting) {
        if ($setting->group != $group && !empty($group)) {
            $table .= "<tr><td colspan=\"4\"><hr /></td></tr>";
        }
        $group = $setting->group;
        $table .= "<tr><td>{$setting->key}</td><td>{$setting->value}</td><td>{$setting->group}</td>"
                . "<td class=\"text-right\"><a class=\"btn btn-default btn-xs\" onclick=\"editSetting('{$setting->key}');\"><i class=\"fa fa-edit\"></i> Edit</a>"
                . " <a class=\"btn btn-default btn-xs\" onclick=\"deleteSetting('{$setting->key}');\"><i class=\"fa fa-remove\"></i> Delete</a></td></tr>";
    }
    $table .= "</tbody>";
    system\Helper::arcReturnJSON(["html" => $table]);
}
