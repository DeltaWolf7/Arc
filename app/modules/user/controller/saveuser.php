<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = new User();
    $user->getByID($_POST["id"]);
    // password settings
    if (!empty($_POST["password"])) {
        if (strlen($_POST["password"]) > 0 && ($_POST["password"] == $_POST["retype"])) {
            $user->setPassword($_POST["password"]);
        } else {
            system\Helper::arcAddMessage("danger", "Password and retyped password do not match");
            return;
        }
    }
    $user->firstname = ucwords(strtolower($_POST["firstname"]));
    if (empty($_POST["firstname"])) {
        system\Helper::arcAddMessage("danger", "Firstname cannot be empty");
        return;
    }

    $user->lastname = ucwords(strtolower($_POST["lastname"]));
    if (empty($_POST["lastname"])) {
        system\Helper::arcAddMessage("danger", "Lastname cannot be empty");
        return;
    }

    $test = User::getByEmail($_POST["email"]);
    if ($user->id == 0 && $test->id != 0) {
        system\Helper::arcAddMessage("danger", "User already exists with this email address");
        return;
    }

    if ($user->id == 0 && empty($_POST["password"])) {
        system\Helper::arcAddMessage("danger", "New users must have a password");
        return;
    }

    if ($_POST["enabled"] == "true") {
        $user->enabled = 1;
    } else {
        $user->enabled = 0;
    }

    $user->email = strtolower($_POST["email"]);
    $user->update();
    system\Helper::arcAddMessage("success", "Changes saved");
}