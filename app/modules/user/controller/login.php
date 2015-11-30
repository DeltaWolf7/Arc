<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if (empty($_POST["email"])) {
        system\Helper::arcAddMessage("danger", "Email address must be provided");
        return;
    }

    if (empty($_POST["password"])) {
        system\Helper::arcAddMessage("danger", "Password must be provided");
        return;
    }

    $user = \User::getByEmail($_POST["email"]);

    if ($user->verifyPassword($_POST["password"])) {
        if ($user->enabled) {
            system\Helper::arcSetUser($user);
            Log::createLog("success", "user", "User logged in: " . $_POST["email"]);
            system\Helper::arcAddMessage("success", "Login successful.");

            system\Helper::arcCheckSettingExists("ARC_LOGIN_URL", "/", "Login");

            $url = SystemSetting::getByKey("ARC_LOGIN_URL");
            system\Helper::arcReturnJSON(["url" => $url->value]);
            return;
        } else {
            system\Helper::arcAddMessage("danger", "Account disabled");
            Log::createLog("danger", "user", "Attempt to access disabled account: " . $_POST["email"]);
            return;
        }
    }
    system\Helper::arcAddMessage("danger", "Invalid username and/or password");
    Log::createLog("warning", "user", "Incorrect password: " . $_POST["email"]);
} else {
    return system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath("user") . "js/login.js");
}