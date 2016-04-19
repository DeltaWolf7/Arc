<?php

if (system\Helper::arcIsAjaxRequest()) {

    if (empty($_POST["firstname"])) {
        system\Helper::arcAddMessage("danger", "Please enter your firstname");
        return;
    }

    if (empty($_POST["lastname"])) {
        system\Helper::arcAddMessage("danger", "Please enter your lastname");
        return;
    }

    if (empty($_POST["emailr"])) {
        system\Helper::arcAddMessage("danger", "Please enter your email address");
        return;
    }

    if (!filter_var($_POST["emailr"], FILTER_VALIDATE_EMAIL)) {
        system\Helper::arcAddMessage("danger", "Invalid email address entered");
        return;
    }

    if (empty($_POST["passwordr"])) {
        system\Helper::arcAddMessage("danger", "Please enter your password");
        return;
    }

    if (empty($_POST["passwordr2"])) {
        system\Helper::arcAddMessage("danger", "Please retype your password");
        return;
    }

    if ($_POST["passwordr"] != $_POST["passwordr2"]) {
        system\Helper::arcAddMessage("danger", "Passwords do not match");
        return;
    }

    $user = User::getByEmail($_POST["emailr"]);
    if ($user->id > 0) {
        system\Helper::arcAddMessage("danger", "User already exists with that email address");
        return;
    }

    $user->firstname = ucfirst(strtolower($_POST["firstname"]));
    $user->lastname = ucfirst(strtolower($_POST["lastname"]));
    $user->email = strtolower($_POST["emailr"]);
    if (empty($user->email)) {
        system\Helper::arcAddMessage("danger", "Please specifiy an email address");
        return;
    }
    $user->setPassword($_POST["passwordr"]);
    $user->update();

    system\Helper::arcSetUser($user);
    system\Helper::arcAddMessage("success", "Your details have been registered");

    system\Helper::arcCheckSettingExists("ARC_LOGIN_URL", "/");
    $url = SystemSetting::getByKey("ARC_LOGIN_URL");
    system\Helper::arcReturnJSON(["redirect" => $url->value]);
} else {
    system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath() . "js/register.js");
}
