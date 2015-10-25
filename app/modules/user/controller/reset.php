<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if (empty($_POST["password"])) {
        system\Helper::arcAddMessage("danger", "A new password must be provided");
        return;
    }

    if (empty($_POST["password2"])) {
        system\Helper::arcAddMessage("danger", "Password must be provided twice");
        return;
    }

    if ($_POST["password"] != $_POST["password2"]) {
        system\Helper::arcAddMessage("danger", "Passwords do not match");
        return;
    }

    $user = new User();
    $user->getByID($_POST["id"]);
    $user->setPassword($_POST["password"]);
    $user->update();
    system\Helper::arcAddMessage("success", "Your password has been reset. You can now login");
    Log::createLog("warning", "user", "Password reset: " . $user->email);
} else {
    system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath("user") . "js/reset.js");
}