<?php

require_once "app/system/Config.php";
new system\Config();

// Set debug environment.
switch (ARCDEBUG) {
    case true:
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        break;
    case false:
        error_reporting(0);
        ini_set('display_errors', 0);
        break;
    default:
        die("Unknown debug setting in Config.php");
        break;
}

// Include and initilise helper class.
require_once "app/system/Helper.php";
system\Helper::init();

// Setup autoloader.
spl_autoload_register(function($class) {
    if (file_exists("app/classes/{$class}.class.php")) {
        require_once "app/classes/{$class}.class.php";
    }
});

$apikey = \SystemSetting::getByKey("ARC_APIKEY");

$ch = curl_init(system\Helper::arcGetPath());
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "api=taskengine&key={$apikey->value}");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
echo curl_exec($ch);
