<?php

system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath() . "js/systemsettings.js");

$logs = SystemSetting::getByKey("ARC_KEEP_LOGS");
$file_size = SystemSetting::getByKey("ARC_FILE_UPLOAD_SIZE_BYTES");
$theme_setting = SystemSetting::getByKey("ARC_THEME");
$thumb = SystemSetting::getByKey("ARC_THUMB_WIDTH");
$login_url = SystemSetting::getByKey("ARC_LOGIN_URL");
$default_page = SystemSetting::getByKey("ARC_DEFAULT_PAGE");
$mail = SystemSetting::getByKey("ARC_MAIL");
$ldap = SystemSetting::getByKey("ARC_LDAP");
$apikey = \SystemSetting::getByKey("ARC_APIKEY");
$reg = \SystemSetting::getByKey("ARC_ALLOWREG");
$logo = \SystemSetting::getByKey("ARC_LOGO_PATH");
$dateformat = \SystemSetting::getByKey("ARC_DATEFORMAT");
$timeformat = \SystemSetting::getByKey("ARC_TIMEFORMAT");
$company = \SystemSetting::getByKey("ARC_REQUIRECOMPANY");
