<?php

if (system\Helper::arcIsAjaxRequest()) {

    $currentUser = system\Helper::arcGetUser();
    $user = User::getByID($_POST["id"]);

    if ($user->id != system\Helper::arcGetUser()->id) {
        system\Helper::arcImpersonateUser($user);
        system\Helper::arcAddMessage("success", "Impersonation mode enabled");
        Log::createLog("warning", "user", $currentUser->getFullname() . " is impersonating " . $user->getFullname());
        system\Helper::arcReturnJSON(["status" => "success"]);
    } else {
        system\Helper::arcAddMessage("danger", "You cannot impersonate yourself");
        system\Helper::arcReturnJSON(["status" => "failed"]);
    }
}