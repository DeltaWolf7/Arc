<?php

if (system\Helper::arcIsAjaxRequest()) {
    $users = User::getAllUsers();
    $html = "";
    foreach ($users as $user) {
        $apikey = SystemSetting::getByKey("APIKEY", $user->id);
        
        if ($apikey->id != 0) {
            $html .= "<tr><td>{$user->getFullname()} ({$user->email})</td><td>{$apikey->value}</td><td><a class=\"btn btn-danger btn-sm\" onclick=\"removeApiKey({$user->id})\"><i class=\"fa fa-close\"></i></a></td></tr>";
        }
    }

    system\Helper::arcReturnJSON(["html" => $html]);
}