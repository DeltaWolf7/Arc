<?php

$module_info["name"] = "Arc Login Module";
$module_info["description"] = "Arc core module providing user login.";
$module_info["version"] = ARCVERSION;
$module_info["author"] = "Craig Longford";
$module_info["email"] = "deltawolf7@gmail.com";
$module_info["www"] = "http://www.deltasblog.co.uk";
$module_info["system"] = true;

if (system\Helper::arcGetUser() == null) {
    system\Helper::arcAddMenuItem("Login", "fa-user", false, system\Helper::arcGetPath() . "user/login", null);
    system\Helper::arcAddMenuItem("Register", "fa-pencil", false, system\Helper::arcGetPath() . "user/register", null);
} else {
    system\Helper::arcAddMenuItem("Profile", "fa-user", false, system\Helper::arcGetPath() . "user/details", null);
    system\Helper::arcAddMenuItem("Logout", "fa-lock", false, system\Helper::arcGetPath() . "user/logout", null);
}