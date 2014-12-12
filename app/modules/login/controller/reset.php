<?php

if (count($_POST) > 0) {
    if (empty($_POST["password"])) {
        echo "danger|<strong>Password</strong> must be provided";
        return;
    }

    if (empty($_POST["retype"])) {
        echo "danger|<strong>Password retype</strong> must be provided";
        return;
    }

    if ($_POST["password"] != $_POST["retype"]) {
        echo "danger|Passwords do not match";
        return;
    }

    $user = new User();
    $user->getByID($_POST["id"]);
    $user->setPassword($_POST["password"]);
    $user->update();

    echo "success|Password reset";
}