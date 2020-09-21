<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByID($_POST["id"]);
    $usercrm = ArcCRMUser::getByUserID($user->id);
    if ($usercrm->id == 0) {
        $usercrm = new ArcCRMUser();
        $usercrm->userid = $user->id;
    }

    //// USER

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

    $user->enabled = $_POST["enabled"];
    $user->email = strtolower($_POST["email"]);
    $user->update();

    //// USER CRM

    $usercrm->company = ucwords(strtolower($_POST["company"]));
    $usercrm->source = $_POST["source"];
    $usercrm->addresslines = ucwords(strtolower($_POST["addresslines"]));
    $usercrm->county = ucwords(strtolower($_POST["county"]));
    $usercrm->postcode = strtoupper($_POST["postcode"]);
    $usercrm->country = ucwords(strtolower($_POST["country"]));
    $usercrm->phone = $_POST["phone"];
    $usercrm->notes = $_POST["notes"];
    $usercrm->userid = $user->id;
    $usercrm->update();

    system\Helper::arcAddMessage("success", "User updated");
    system\Helper::arcReturnJSON();
}