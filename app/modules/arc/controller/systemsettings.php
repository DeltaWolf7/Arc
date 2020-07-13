<?php

system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath() . "js/systemsettings.js");

$logs = SystemSetting::getByKey("ARC_KEEP_LOGS");
$file_size = SystemSetting::getByKey("ARC_FILE_UPLOAD_SIZE_BYTES");
$theme_setting = SystemSetting::getByKey("ARC_THEME");
$login_url = SystemSetting::getByKey("ARC_LOGIN_URL");

$smtpEnabled = SystemSetting::getByKey("ARC_MAIL_USESMTP");
$smtpServer = SystemSetting::getByKey("ARC_MAIL_SERVER");
$smtpUsername = SystemSetting::getByKey("ARC_MAIL_USERNAME");
$smtpPassword = SystemSetting::getByKey("ARC_MAIL_PASSWORD");
$smtpPort = SystemSetting::getByKey("ARC_MAIL_PORT");
$smtpSender = SystemSetting::getByKey("ARC_MAIL_SENDER");

$ldapEnabled = SystemSetting::getByKey("ARC_LDAP_ENABLED");
$ldapServer = SystemSetting::getByKey("ARC_LDAP_SERVER");
$ldapDomain = SystemSetting::getByKey("ARC_LDAP_DOMAIN");
$ldapBase = SystemSetting::getByKey("ARC_LDAP_BASE");

$reg = \SystemSetting::getByKey("ARC_ALLOWREG");
$logo = \SystemSetting::getByKey("ARC_LOGO_PATH");
$dateformat = \SystemSetting::getByKey("ARC_DATEFORMAT");
$timeformat = \SystemSetting::getByKey("ARC_TIMEFORMAT");
$title = \SystemSetting::getByKey("ARC_SITETITLE");
$media = \SystemSetting::getByKey("ARC_MEDIAMANAGERURL");

$gAdsense = \SystemSetting::getByKey("ARC_GADSENSE");