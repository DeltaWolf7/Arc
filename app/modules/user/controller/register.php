<?php

if (system\Helper::arcIsAjaxRequest() == true) {

    if (empty($_POST["firstname"])) {
        system\Helper::arcAddMessage("danger", "Firstname must be provided");
        return;
    }

    if (empty($_POST["lastname"])) {
        system\Helper::arcAddMessage("danger", "Lastname must be provided");
        return;
    }

    if (empty($_POST["email"])) {
        system\Helper::arcAddMessage("danger", "Email address must be provided");
        return;
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        system\Helper::arcAddMessage("danger", "Invalid email address format");
        return;
    }

    if (empty($_POST["password"])) {
        system\Helper::arcAddMessage("danger", "Password must be provided");
        return;
    }

    if (empty($_POST["password2"])) {
        system\Helper::arcAddMessage("danger", "Password retype must be provided");
        return;
    }

    if ($_POST["password"] != $_POST["password2"]) {
        system\Helper::arcAddMessage("danger", "Passwords do not match");
        return;
    }

    $user = User::getByEmail($_POST["email"]);
    if ($user->id > 0) {
        system\Helper::arcAddMessage("danger", "User already exists with that email address");
        return;
    }

    $user->firstname = ucfirst($_POST["firstname"]);
    $user->lastname = ucfirst($_POST["lastname"]);
    $user->email = strtolower($_POST["email"]);
    if (empty($user->email)) {
        system\Helper::arcAddMessage("danger", "Please specifiy an email address");
        return;
    }
    $user->setPassword($_POST["password"]);
    $user->update();

    system\Helper::arcSetUser($user);
    system\Helper::arcAddMessage("success", "Your details have been registered");
}
