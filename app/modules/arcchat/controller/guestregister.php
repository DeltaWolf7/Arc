<?php

if (system\Helper::arcIsAjaxRequest()) {

    if (empty($_POST["firstname"])) {
        system\Helper::arcAddMessage("danger", "Please enter your firstname");
        system\Helper::arcReturnJSON([]);
        return;
    }

    if (empty($_POST["lastname"])) {
        system\Helper::arcAddMessage("danger", "Please enter your lastname");
        system\Helper::arcReturnJSON([]);
        return;
    }
    
    if (empty($_POST["emailr"])) {
        system\Helper::arcAddMessage("danger", "Please enter your email address");
        system\Helper::arcReturnJSON([]);
        return;
    }

    if (!filter_var($_POST["emailr"], FILTER_VALIDATE_EMAIL)) {
        system\Helper::arcAddMessage("danger", "Invalid email address entered");
        system\Helper::arcReturnJSON([]);
        return;
    }

    $user = User::getByEmail($_POST["emailr"]);
    if ($user->id > 0) {
        system\Helper::arcAddMessage("danger", "User already exists with that email address");
        system\Helper::arcReturnJSON([]);
        return;
    }

    $user->firstname = ucfirst(strtolower($_POST["firstname"]));
    $user->lastname = ucfirst(strtolower($_POST["lastname"]));
    $user->email = strtolower($_POST["emailr"]);
    if (empty($user->email)) {
        system\Helper::arcAddMessage("danger", "Please specifiy an email address");
        system\Helper::arcReturnJSON([]);
        return;
    }
    $password = md5(uniqid($user->email, true));
    $user->setPassword($password);
    
    // save user
    $user->update();
       
    system\Helper::arcSetUser($user);
    system\Helper::arcAddMessage("success", "Your details have been registered");
    system\Helper::arcReturnJSON(["redirect" => "/"]);
}
