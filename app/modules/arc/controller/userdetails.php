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

    $user->firstname = ucfirst(strtolower($_POST["firstname"]));
    $user->lastname = ucfirst(strtolower($_POST["lastname"]));
    $user->update();
    
    $company = SystemSetting::getByKey("ARC_REQUIRECOMPANY");
    if (!empty($_POST["company"]) && $company->value == "true") {
        $comp = Company::getByName(ucwords($_POST["company"]));
        if ($comp->id == 0) {
            $comp = new Company();
            $comp->name = ucwords($_POST["company"]);
            $comp->update();
        }
        
        $compsetting = SystemSetting::getByKey("ARC_COMPANY", $user->id);
        $compsetting->value = $comp->id;
        $compsetting->update();
    }
    
    system\Helper::arcSetUser($user);
    system\Helper::arcAddMessage("success", "Changes saved");
} else {
    system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath() . "js/userdetails.js");
}