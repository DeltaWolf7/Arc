<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByID($_POST["id"]);
    // password settings
    if (!empty($_POST["password"])) {
        if (strlen($_POST["password"]) > 0 && ($_POST["password"] == $_POST["retype"])) {
            $user->setPassword($_POST["password"]);
        } else {
            system\Helper::arcAddMessage("danger", "Password and retyped password do not match");
            return;
        }
    }
    $user->firstname = ucwords(strtolower($_POST["firstname"]));
    if (empty($_POST["firstname"])) {
        system\Helper::arcAddMessage("danger", "Firstname cannot be empty");
        return;
    }

    $user->lastname = ucwords(strtolower($_POST["lastname"]));
    if (empty($_POST["lastname"])) {
        system\Helper::arcAddMessage("danger", "Lastname cannot be empty");
        return;
    }

    $test = User::getByEmail($_POST["email"]);
    if ($user->id == 0 && $test->id != 0) {
        system\Helper::arcAddMessage("danger", "User already exists with this email address");
        return;
    }

    if ($user->id == 0 && empty($_POST["password"])) {
        system\Helper::arcAddMessage("danger", "New users must have a password");
        return;
    }
    
    if (!empty($_POST["company"])) {
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

    if ($_POST["enabled"] == "true") {
        $user->enabled = 1;
    } else {
        $user->enabled = 0;
    }

    $user->email = strtolower($_POST["email"]);
    $user->update();
    system\Helper::arcAddMessage("success", "Changes saved");
}