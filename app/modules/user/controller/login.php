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
            system\Helper::arcAddMessage("success", "Login successful");
            return;
        } else {
            system\Helper::arcAddMessage("danger", "Account disabled");
            return;
        }
    }
    system\Helper::arcAddMessage("danger", "Invalid username and/or password");
}