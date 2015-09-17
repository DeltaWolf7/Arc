<?php

if (system\Helper::arcGetURLData("action") == null) {
    if (system\Helper::arcGetUser() != null) {
        system\Helper::arcRedirect();
    }
    system\Helper::arcOverrideView("default");
}