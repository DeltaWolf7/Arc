<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByID($_POST["id"]);
    $user->delete();
    $settings = SystemSetting::getAll($_POST["id"]);
    foreach ($settings as $setting) {
        $setting->delete();
    }
    $crmuser = CRMUser::getByUserID($user->id);
    $crmuser->delete();
    $contacts =  CRMUserContact::getAllByUserID($user->id);
    foreach ($contacts as $contact) {
        $contact->delete();
    }
    $links = CRMUserLink::getAllByUserID($user->id);
    foreach ($links as $link) {
        $link->delete();
    }
    system\Helper::arcReturnJSON();
}