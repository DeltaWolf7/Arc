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

// Prevent PHP7 bug with memcache
ini_set('session.lazy_write', 0);

// Security Hardening. https://php.watch/articles/PHP-Samesite-cookies
header("X-XSS-Protection: 1; mode=block");
header("Strict-Transport-Security:max-age=63072000");
ini_set("session.cookie_httponly", True);
if (array_key_exists('HTTPS', $_SERVER) && (isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'on')) {
    // check if ssl, if so enable security hardening for ssl.
    ini_set("session.cookie_secure", True);
    ini_set("session.cookie_samesite", "Strict");
}

// Hide PHP version
if (function_exists('header_remove')) {
    header_remove('X-Powered-By'); // PHP 5.3+
}

// Check that we are using PHP 7 or newer.
if (version_compare(phpversion(), '7.0', '<') == true) {
    die('PHP 5.5 or newer required');
}

// Check we have a config file and include
if (!is_readable('app/system/Config.php')) {
    die('No Config.php found, configure and rename Config.php.dist to Config.php in app/system.');
}
require_once 'app/system/Config.php';
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
        die('Unknown debug setting in Config.php');
        break;
}

// Include and initilise helper class.
require_once 'app/system/Initialiser.php';
require_once 'app/system/API.php';
require_once 'app/system/Render.php';
require_once 'app/system/Helper.php';
system\Helper::Init();

// Setup autoloader.
spl_autoload_register(function($class) {
    if (file_exists("app/system/classes/{$class}.class.php")) {
        // load inbuilt classes
        require_once "app/system/classes/{$class}.class.php";
    } elseif (file_exists("app/classes/{$class}.class.php")) {
        // load module classes
        require_once "app/classes/{$class}.class.php";
    }
});

// Initialiser
system\Initialiser::Init();

// Get content
system\Helper::arcGetContent();
