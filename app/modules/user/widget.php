<?php

if (system\Helper::arcIsAjaxRequest() == false) {
    $state = system\Helper::arcGetPostData("loginState");

    switch ($state) {

        default:
            system\Helper::arcAddFooter("js", system\Helper::arcGetWidgetPath("user") . "js/login.js");
            include system\Helper::arcGetWidgetPath("user", true) . "view/login.php";
            break;
    }
} else {
    switch (system\Helper::arcGetPostData("action")) {
        case "login":
            include system\Helper::arcGetWidgetPath("user") . "controller/login.php";
            break;
    }
}