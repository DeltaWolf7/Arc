<?php

system\Helper::arcAddHeader("title", "Reset Password");

if (system\Helper::arcIsAjaxRequest() == true) {
    if (empty($_POST["password"])) {
        echo json_encode(["status" => "danger", "data" => "A new password must be provided"]);
        return;
    }

    if (empty($_POST["password2"])) {
        echo json_encode(["status" => "danger", "data" => "Password must be provided twice"]);
        return;
    }

    if ($_POST["password"] != $_POST["password2"]) {
        echo json_encode(["status" => "danger", "data" => "Passwords do not match"]);
        return;
    }

    $user = new User();
    $user->getByID($_POST["id"]);
    $user->setPassword($_POST["password"]);
    $user->update();

    echo json_encode(["status" => "success", "data" => "Your password has been reset"]);
}