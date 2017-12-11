<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByID($_POST["id"]);
    $user->delete();
    $settings = SystemSetting::getAll($_POST["id"]);
    foreach ($settings as $setting) {
        $setting->delete();
    }
    system\Helper::arcReturnJSON();
}