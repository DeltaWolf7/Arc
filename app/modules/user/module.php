<?php

if (system\Helper::arcGetUser() == null) {
    system\Helper::arcAddMenuItem("Login", "fa-sign-in", false, system\Helper::arcGetPath() . "user/login", null);
    system\Helper::arcAddMenuItem("Register", "fa-pencil", false, system\Helper::arcGetPath() . "user/register", null);
} else {
    system\Helper::arcAddMenuItem("Details", "fa-user", false, system\Helper::arcGetPath() . "user/details", "Account");
    system\Helper::arcAddMenuItem("Logout", "fa-sign-out", false, system\Helper::arcGetPath() . "user/logout", "Account");
}