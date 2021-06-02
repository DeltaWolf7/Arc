<?php

if (system\Helper::arcIsAjaxRequest()) {
    $users = User::getAllUsers();
    $html = "";
    $userList = "";
    foreach ($users as $user) {
        $apikey = SystemSetting::getByKey("APIKEY", $user->id);
        
        if ($apikey->id != 0) {
            $html .= "<tr><td>{$user->getFullname()} ({$user->email})</td><td>{$apikey->value}</td>"
            . "<td class=\"text-end\">"
            . "<button class=\"btn btn-danger btn-sm\" onclick=\"removeApiKey({$user->id})\"><i class=\"fa fa-close\"></i></button>"
            . " <button class=\"btn btn-primary btn-sm\" onclick=\"copyToClipboard('{$apikey->value}')\"><i class=\"far fa-clipboard\"></i></button>"
            . "</td></tr>";
        } else {
            $userList .= "<option value=\"{$user->id}\">{$user->getFullname()} ({$user->email})</option>";
        }
    }

    system\Helper::arcReturnJSON(["html" => $html, "users" => $userList]);
}