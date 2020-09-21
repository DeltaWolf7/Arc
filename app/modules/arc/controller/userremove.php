<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByID($_POST["id"]);
    $user->delete();
    $settings = SystemSetting::getAll($_POST["id"]);
    foreach ($settings as $setting) {
        $setting->delete();
    }
    $crmuser = ArcCRMUser::getByUserID($user->id);
    $crmuser->delete();
    $contacts =  ArcCRMUserContact::getAllByUserID($user->id);
    foreach ($contacts as $contact) {
        $contact->delete();
    }
    system\Helper::arcReturnJSON();
}