<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByID($_POST["id"]);
    $hasError = false;

    // password settings
    if (!empty($_POST["password"])) {
        if (strlen($_POST["password"]) > 0 && ($_POST["password"] == $_POST["retype"])) {
            $user->setPassword($_POST["password"]);
        } else {
            system\Helper::arcAddMessage("danger", "Password and retyped password do not match");
            $hasError = true;
        }
    }

    $user->firstname = ucwords(strtolower(trim($_POST["firstname"])));
    if (empty($_POST["firstname"]) && !$hasError) {
        system\Helper::arcAddMessage("danger", "Firstname cannot be empty");
        $hasError = true;
    }

    $user->lastname = ucwords(strtolower(trim($_POST["lastname"])));
    if (empty($_POST["lastname"]) && !$hasError) {
        system\Helper::arcAddMessage("danger", "Lastname cannot be empty");
        $hasError = true;
    }

    if (!filter_var(strtolower(trim($_POST["email"])), FILTER_VALIDATE_EMAIL)) {
        system\Helper::arcAddMessage("danger", "Invalid email address");
        $hasError = true;
    }

    $test = User::getByEmail(trim($_POST["email"]));
    if ($user->id == 0 && $test->id != 0 && !$hasError) {
        system\Helper::arcAddMessage("danger", "User already exists with this email address");
        $hasError = true;
    }

    if ($user->id == 0 && empty($_POST["password"]) && !$hasError) {
        system\Helper::arcAddMessage("danger", "New users must have a password");
        $hasError = true;
    }


    if (!$hasError) {
        $user->enabled = $_POST["enabled"];
        $user->email = strtolower(trim($_POST["email"]));
        $user->update();
        system\Helper::arcAddMessage("success", "User updated");
    } 

    if (isset($_POST["clearImage"])) {
        $profileImage = SystemSetting::getByKey("ARC_USER_IMAGE", $user->id);
        $profileImage->delete();
    }

    system\Helper::arcReturnJSON(["id" => $user->id]);
}