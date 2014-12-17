<?php

if (system\Helper::arcGetURLData("action") == null) {
    if (system\Helper::arcGetUser() != null) {
        system\Helper::arcRedirect();
    }
    system\Helper::arcOverrideView("login");
}

if (system\Helper::arcGetURLData("action") == "details" && system\Helper::arcGetUser() == null) {
    system\Helper::arcOverrideView("login");
}