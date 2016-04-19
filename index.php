<?php

/*
 * The MIT License
 *
 * Copyright 2015 Craig Longford.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

// Hide PHP version
if (function_exists('header_remove')) {
    header_remove('X-Powered-By'); // PHP 5.3+
} else {
    @ini_set('expose_php', 'off');
}

// Check for old versons of Internet Explorer
if (preg_match('/(?i)msie [1-10]/', $_SERVER['HTTP_USER_AGENT'])) {
// if IE<=11
    echo "<div class=\"alert alert-danger\">Warning! You are using an old unsupported version of Internet Explorer."
    . " Please upgrade to version 11 or newer</div>";
}

// Check that we are using PHP 5.4 or better.
if (version_compare(phpversion(), "5.4.0", "<") == true) {
    die("PHP 5.4 or newer required");
}

// Check we have a config file and include
if (!is_readable("app/system/Config.php")) {
    die("No Config.php found, configure and rename Config.php.dist to Config.php in app/system.");
}
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

// Check the assets directory exists and create it if not.
if (!file_exists(system\Helper::arcGetPath(true) . "assets")) {
    echo "<div class=\"alert alert-warning\">Assets directory not found. Arc will try to create it.</div>";
    try {
        mkdir(system\Helper::arcGetPath(true) . "assets");
        echo "<div class=\"alert alert-success\">Assets directory created.</div>";
    } catch (Exception $ex) {
        echo "<div class=\"alert alert-danger\">Unable to create assets directory. Error: " . $e->getMessage() . "</div>";
    }
}

// Setup autoloader.
spl_autoload_register(function($class) {
    if (file_exists("app/classes/{$class}.class.php")) {
        require_once "app/classes/{$class}.class.php";
    } elseif (file_exists("app/classes/modules/{$class}.class.php")) {
        require_once "app/classes/modules/{$class}.class.php";
    }
});

// Default system settings
system\Helper::arcCheckSettingExists("ARC_MAIL", "{\"smtp\":\"false\", \"server\":\"localhost\""
        . ", \"username\":\"\", \"password\":\"\", \"port\":\"25\", \"sender\":\"admin@server.local\"}");
system\Helper::arcCheckSettingExists("ARC_LOGIN_URL", "welcome");
system\Helper::arcCheckSettingExists("ARC_FILE_UPLOAD_SIZE_BYTES", "2000000");
system\Helper::arcCheckSettingExists("ARC_THUMB_WIDTH", "80");
system\Helper::arcCheckSettingExists("ARC_KEEP_LOGS", "31");
system\Helper::arcCheckSettingExists("ARC_THEME", "default");
system\Helper::arcCheckSettingExists("ARC_DEFAULT_PAGE", "welcome");
system\Helper::arcCheckSettingExists("ARC_LDAP", "{\"ldap\":\"false\", \"server\":\"localhost\","
        . " \"domain\":\"mydomain\", \"base\":\"dc=mydomain,dc=local\"}");
system\Helper::arcCheckSettingExists("ARC_VERSION", "0.4.0.2");
system\Helper::arcCheckSettingExists("ARC_APIKEY", md5(microtime() . rand()));
system\Helper::arcCheckSettingExists("ARC_PASSWORD_RESET_MESSAGE", htmlentities("You or someone else has requested a password reset.<br />"
                . "Your new password is '{password}'."));
system\Helper::arcCheckSettingExists("ARC_ALLOWREG", "true");

// Get content
system\Helper::GetContent();
