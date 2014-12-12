<?php

if (count($_POST) > 0) {
    if (empty($_POST["email"])) {
        echo "danger|<strong>Email address</strong> must be provided";
        return;
    }

    if (empty($_POST["password"])) {
        echo "danger|<strong>Password</strong> must be provided";
        return;
    }

    $user = \User::getByEmail($_POST["email"]);

    if ($user->verifyPassword($_POST["password"])) {
        if ($user->enabled) {
            system\Helper::arcSetUser($user);
            echo "success|Login successful";
            return;
        } else {
            echo "danger|Account disabled";
            return;
        }
    }
    echo "danger|Invalid username and/or password";
}