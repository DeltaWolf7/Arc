<?php

if (system\Helper::arcIsAjaxRequest()) {
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

    if (!empty($_POST["firstname"]) && !empty($_POST["lastname"])) {
        $user->firstname = ucfirst(strtolower(trim($_POST["firstname"])));
        $user->lastname = ucfirst(strtolower(trim($_POST["lastname"])));
    } else {
        system\Helper::arcAddMessage("danger", "Please provide a first and lastname.");
        return;
    }
    $user->update();
        
    system\Helper::arcSetUser($user);
    system\Helper::arcAddMessage("success", "Changes saved");
    system\Helper::arcReturnJSON();
}