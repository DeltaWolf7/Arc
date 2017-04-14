<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = new User();
    $user->delete($_POST["id"]);
    $settings = SystemSetting::getAll($_POST["id"]);
    foreach ($settings as $setting) {
        $setting->delete($_POST["id"]);
    }
}