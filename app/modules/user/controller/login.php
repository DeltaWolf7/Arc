<?php

system\Helper::arcAddHeader("title", "Account Login");

if (count($_POST) > 0) {
    if (empty($_POST["email"])) {
        echo json_encode(["status" => "danger", "data" => "Email address must be provided"]);
        return;
    }

    if (empty($_POST["password"])) {
        echo json_encode(["status" => "danger", "data" => "Password must be provided"]);
        return;
    }

    $user = \User::getByEmail($_POST["email"]);

    if ($user->verifyPassword($_POST["password"])) {
        if ($user->enabled) {
            system\Helper::arcSetUser($user);
            echo json_encode(["status" => "success", "data" => "Login successful"]);
            return;
        } else {
            echo json_encode(["status" => "danger", "data" => "Account disabled"]);
            return;
        }
    }
    echo json_encode(["status" => "danger", "data" => "Invalid username and/or password"]);
}