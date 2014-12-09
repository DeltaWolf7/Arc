<?php 

/*
 * The MIT License
 *
 * Copyright 2014 Craig Longford.
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

echo $_SERVER[REQUEST_URI];

// check that we are using PHP 5.3 or better.
if (version_compare(phpversion(), "5.3.0", "<") == true) {
    exit("PHP 5.3 or newer required");
}

// make sure we have the correct time zone.
if (!ini_get("date.timezone")) {
    date_default_timezone_set("Europe/London");
}

// check for config
if (!file_exists(__DIR__  . "/config.php")) {
    exit("Config.php was not found in the root directory. '" . __DIR__  . "/config.php" . "'");
}

// get config file
require_once __DIR__  . "/config.php";

// check if debug is enabled
if (ARCDEBUG == true) {
    error_reporting(E_ALL);
    ini_set("display_errors", "1");
}

// start session
session_start();

// include the required system file
require_once __DIR__  . "/system/bootstrap.php";

// get the view of the page
arcGetContent();