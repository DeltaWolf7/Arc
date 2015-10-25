<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $user = system\Helper::arcGetUser();

    // password settings
    if (!empty($_POST["password"])) {
        if (strlen($_POST["password"]) > 0 && ($_POST["password"] == $_POST["password2"])) {
            $user->setPassword($_POST['password']);
        } else {
            system\Helper::arcAddMessage("danger", "Password and retyped password do not match");
            return;
        }
    }

    $user->firstname = ucfirst(strtolower($_POST["firstname"]));
    $user->lastname = ucfirst(strtolower($_POST["lastname"]));
    $user->update();
    system\Helper::arcSetUser($user);
    system\Helper::arcAddMessage("success", "Changes saved");
} else {
    system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath("user") . "js/details.js");
}