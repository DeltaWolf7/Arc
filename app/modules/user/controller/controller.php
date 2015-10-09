<?php

if (system\Helper::arcGetURLData("action") == null) {
    if (system\Helper::arcGetUser() != null) {
        system\Helper::arcRedirect();
    }
    system\Helper::arcOverrideView("login");
}

system\Helper::arcAddFooter("js", system\Helper::arcGetModuleAbsolutePath() . "js/user.js");

if (system\Helper::arcGetURLData("action") == "details" && system\Helper::arcGetUser() == null) {
    system\Helper::arcOverrideView("login");
}

switch (system\Helper::arcGetURLData("action")) {
    case "login":
        system\Helper::arcAddHeader("title", "Account Login");
        break;
    case "details":
        system\Helper::arcAddHeader("title", "Account Details");
        break;
    case "forgot":
        system\Helper::arcAddHeader("title", "Forgot Password");
        break;
    case "register":
        system\Helper::arcAddHeader("title", "Register Account");
        break;
    case "reset":
        system\Helper::arcAddHeader("title", "Reset Password");
        break;
}