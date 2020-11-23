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
        $user->firstname = ucfirst(strtolower($_POST["firstname"]));
        $user->lastname = ucfirst(strtolower($_POST["lastname"]));
    } else {
        system\Helper::arcAddMessage("danger", "Please provide a first and lastname.");
        return;
    }
    $user->update();

    $crmuser = CRMUser::getByUserID($user->id);
    if ($crmuser->id == 0) {
        $crmuser  = new CRMUser();
        $crmuser->userid = $user->id;
    }
    $crmuser->phone = $_POST["phone"];
    $crmuser->update();
        
    system\Helper::arcSetUser($user);
    system\Helper::arcAddMessage("success", "Changes saved");
    system\Helper::arcReturnJSON();
}