<?php

system\Helper::arcAddHeader("title", "Register Account");

if (system\Helper::arcIsAjaxRequest() == true) {

    if (empty($_POST["firstname"])) {
        echo json_encode(["status" => "danger", "data" => "Firstname must be provided"]);
        return;
    }

    if (empty($_POST["lastname"])) {
        echo json_encode(["status" => "danger", "data" => "Lastname must be provided"]);
        return;
    }

    if (empty($_POST["email"])) {
        echo json_encode(["status" => "danger", "data" => "Email address must be provided"]);
        return;
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "danger", "data" => "Invalid email address format"]);
        return;
    }

    if (empty($_POST["password"])) {
        echo json_encode(["status" => "danger", "data" => "Password must be provided"]);
        return;
    }

    if (empty($_POST["password2"])) {
        echo json_encode(["status" => "danger", "data" => "Password retype must be provided"]);
        return;
    }

    if ($_POST["password"] != $_POST["password2"]) {
        echo json_encode(["status" => "danger", "data" => "Passwords do not match"]);
        return;
    }

    $user = User::getByEmail($_POST["email"]);
    if ($user->id > 0) {
        echo json_encode(["status" => "danger", "data" => "User already exists with that email address"]);
        return;
    }

    $user->firstname = ucfirst($_POST["firstname"]);
    $user->lastname = ucfirst($_POST["lastname"]);
    $user->email = strtolower($_POST["email"]);
    $user->setPassword($_POST["password"]);
    $user->update();

    system\Helper::arcSetUser($user);
    echo json_encode(["status" => "success", "data" => "Your details have been registered"]);
}
