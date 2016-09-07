<?php

if (system\Helper::arcIsAjaxRequest()) {
    $setting = SystemSetting::getByKey("ARC_KEEP_LOGS");
    $setting->value = $_POST["days"];
    $setting->update();
    
    $setting = SystemSetting::getByKey("ARC_LDAP");
    $setting->value = "{\"ldap\":\"{$_POST["ldap"]}\", \"server\":\"{$_POST["ldapserver"]}\""
    . ", \"domain\":\"{$_POST["domain"]}\", \"base\":\"{$_POST["base"]}\"}";
    $setting->update();
    
    $setting = SystemSetting::getByKey("ARC_DEFAULT_PAGE");
    $setting->value = $_POST["defaultPage"];
    $setting->update();
    
    $setting = SystemSetting::getByKey("ARC_LOGIN_URL");
    $setting->value = $_POST["loginURL"];
    $setting->update();
    
    $password = system\Helper::arcEncrypt($_POST["password"]);
    
    $setting = SystemSetting::getByKey("ARC_MAIL");
    $setting->value = "{\"smtp\":\"{$_POST["smtp"]}\", \"server\":\"{$_POST["smtpserver"]}\""
        . ", \"username\":\"{$_POST["username"]}\", \"password\":\"{$password}\","
        . " \"port\":\"{$_POST["port"]}\", \"sender\":\"{$_POST["sender"]}\"}";
    $setting->update();
    
    $setting = SystemSetting::getByKey("ARC_THEME");
    $setting->value = $_POST["theme"];
    $setting->update();
    
    $setting = SystemSetting::getByKey("ARC_THUMB_WIDTH");
    $setting->value = $_POST["width"];
    $setting->update();
    
    $setting = SystemSetting::getByKey("ARC_FILE_UPLOAD_SIZE_BYTES");
    $setting->value = $_POST["limit"];
    $setting->update();
    
    $setting = SystemSetting::getByKey("ARC_ALLOWREG");
    $setting->value = $_POST["allowReg"];
    $setting->update();
    
    $setting = SystemSetting::getByKey("ARC_LOGO_PATH");
    $setting->value = $_POST["siteLogo"];
    $setting->update();
       
    $setting = SystemSetting::getByKey("ARC_DATEFORMAT");
    $setting->value = $_POST["dateFormat"];
    $setting->update();
    
    $setting = SystemSetting::getByKey("ARC_TIMEFORMAT");
    $setting->value = $_POST["timeFormat"];
    $setting->update();
    
    $setting = SystemSetting::getByKey("ARC_REQUIRECOMPANY");
    $setting->value = $_POST["company"];
    $setting->update();
    
    $setting = SystemSetting::getByKey("ARC_SITETITLE");
    $setting->value = $_POST["siteTitle"];
    $setting->update();
    
    $setting = SystemSetting::getByKey("ARC_MEDIAMANAGERURL");
    $setting->value = $_POST["media"];
    $setting->update();
    
    system\Helper::arcAddMessage("success", "System settings saved.");
}