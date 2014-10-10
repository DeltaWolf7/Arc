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

/**
 * Application bootstrap
 *
 * @author Craig Longford
 */
// start session
session_start();
// get config file
require_once "config.php";

// check if debug is enabled
if (ARCDEBUG == true) {
    error_reporting(E_ALL);
    ini_set("display_errors", "1");
}

// include main functions file
require_once $_SERVER["DOCUMENT_ROOT"] . ARCFS . "system/functions.php";

// setup database connection from config
require_once $_SERVER["DOCUMENT_ROOT"] . ARCFS . "system/medoo.min.php";
try {
    $arc_db = new medoo([
        "database_type" => ARCDBTYPE,
        "database_name" => ARCDBNAME,
        "server" => ARCDBSERVER,
        "username" => ARCDBUSER,
        "password" => ARCDBPASSWORD
    ]);
} catch (Exception $e) {
    echo "Unable to connect to database. Please check 'config.php'";
    echo "<br />Exception: " . $e->getMessage();
    die();
}

// class auto loader
function __autoload($class_name) {
    if (file_exists($_SERVER["DOCUMENT_ROOT"] . ARCFS . "classes/" . $class_name . ".class.php")) {
        require_once($_SERVER["DOCUMENT_ROOT"] . ARCFS . "classes/" . $class_name . ".class.php");
    } elseif (file_exists($_SERVER["DOCUMENT_ROOT"] . ARCFS . "modules/" . arcGetURLData("module") . "/classes/" . $class_name . ".class.php")) {
        require_once($_SERVER["DOCUMENT_ROOT"] . ARCFS . "modules/" . arcGetURLData("module") . "/classes/" . $class_name . ".class.php");
    }
}
