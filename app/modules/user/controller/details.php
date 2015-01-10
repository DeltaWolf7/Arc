<?php

system\Helper::arcAddHeader("title", "Account Details");

if (isset($_POST["id"])) { 
    $user = new User();
    $user->getByID($_POST["id"]);

    // password settings
    if (!empty($_POST["password"])) {
        if (strlen($_POST["password"]) > 0 && ($_POST["password"] == $_POST["password2"])) {
            $user->setPassword($_POST['password']);
        } else {
            echo json_encode(["status" => "danger", "data" => "Password and retyped password do not match"]);
            return;
        }
    }

    $user->firstname = ucfirst($_POST["firstname"]);
    $user->lastname = ucfirst($_POST["lastname"]);
   
    $user->update();
    system\Helper::arcSetUser($user);

    echo json_encode(["status" => "success", "data" => "Changes saved"]);
}