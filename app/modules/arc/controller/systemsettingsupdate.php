<?php

if (system\Helper::arcIsAjaxRequest()) {
    $setting = SystemSetting::getByKey("ARC_KEEP_LOGS");
    $setting->value = $_POST["days"];
    $setting->update();
    
    $setting = SystemSetting::getByKey("ARC_LDAP_ENABLED");
    $setting->value = $_POST["ldap"];
    $setting->update();

    $setting = SystemSetting::getByKey("ARC_LDAP_SERVER");
    $setting->value = $_POST["ldapserver"];
    $setting->update();

    $setting = SystemSetting::getByKey("ARC_LDAP_DOMAIN");
    $setting->value = $_POST["domain"];
    $setting->update();

    $setting = SystemSetting::getByKey("ARC_LDAP_BASE");
    $setting->value = $_POST["base"];
    $setting->update();
       
    $setting = SystemSetting::getByKey("ARC_LOGIN_URL");
    $setting->value = $_POST["loginURL"];
    $setting->update();
    
   
    $setting = SystemSetting::getByKey("ARC_MAIL_USESMTP");
    $setting->value = $_POST["smtp"];
    $setting->update();

    $setting = SystemSetting::getByKey("ARC_MAIL_SERVER");
    $setting->value = $_POST["smtpserver"];
    $setting->update();

    $setting = SystemSetting::getByKey("ARC_MAIL_USERNAME");
    $setting->value = $_POST["username"];
    $setting->update();

    if (strlen($_POST["password"]) > 0) {
        $password = system\Helper::arcEncrypt($_POST["password"]);
    } else {
        $password = "";
    }

    $setting = SystemSetting::getByKey("ARC_MAIL_PASSWORD");
    $setting->value = $password;
    $setting->update();

    $setting = SystemSetting::getByKey("ARC_MAIL_PORT");
    $setting->value = $_POST["port"];
    $setting->update();

    $setting = SystemSetting::getByKey("ARC_MAIL_SENDER");
    $setting->value = $_POST["sender"];
    $setting->update();


    $setting = SystemSetting::getByKey("ARC_THEME");
    $setting->value = $_POST["theme"];
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
    system\Helper::arcReturnJSON(["message" => "OK"]);
}