<?php

if (system\Helper::arcIsAjaxRequest()) {

    $user = new User();
    $user->getByID($_POST["id"]);

    if ($user->id != system\Helper::arcGetUser()->id) {
        system\Helper::arcImpersonateUser($user);
        system\Helper::arcAddMessage("success", "Impersonation mode enabled");
        Log::createLog("warning", "user", "Is impersonating " . $user->getFullname());
    } else {
        system\Helper::arcAddMessage("danger", "You cannot impersonate yourself");
    }
}
