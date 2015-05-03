<?php

if (is_numeric(system\Helper::arcGetURLData("data1"))) {
    http_response_code(system\Helper::arcGetURLData("data1"));
    if (system\Helper::arcGetURLData("data1") == "404") {
        Log::createLog("danger", "error", "Error detected: " . system\Helper::arcGetURLData("data1") . ": " . $_SERVER['REQUEST_URI']);
    } else {
        Log::createLog("danger", "error", "Error detected: " . system\Helper::arcGetURLData("data1"));
    }
}

if (system\Helper::arcGetURLData("action") == null) {
    system\Helper::arcOverrideView("error");
}