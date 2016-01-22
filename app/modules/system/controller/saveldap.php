<?php

if (system\Helper::arcIsAjaxRequest()) {
    $setting = SystemSetting::getByKey("ARC_LDAP");
    $setting->value = "{\"ldap\":\"{$_POST["ldap"]}\", \"server\":\"{$_POST["server"]}\"}";
    $setting->update();
    
    system\Helper::arcAddMessage("success", "LDAP settings saved.");
}