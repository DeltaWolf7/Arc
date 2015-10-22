<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if (empty(system\Helper::arcGetPostData("email"))) {
        system\Helper::arcAddMessage("danger", "Email address must be provided");
        return;
    }

    if (empty(system\Helper::arcGetPostData("password"))) {
        system\Helper::arcAddMessage("danger", "Password must be provided");
        return;
    }

    $user = \User::getByEmail(system\Helper::arcGetPostData("email"));

    if ($user->verifyPassword(system\Helper::arcGetPostData("password"))) {
        if ($user->enabled) {
            system\Helper::arcSetUser($user);
            Log::createLog("success", "user", "User logged in: " . system\Helper::arcGetPostData("email"));    
            system\Helper::arcAddMessage("success", "Login successful<script>window.location='/';</script>");
            return;
        } else {
            system\Helper::arcAddMessage("danger", "Account disabled");
            Log::createLog("danger", "user", "Attempt to access disabled account: " . system\Helper::arcGetPostData("email"));
            return;
        }
    }
    system\Helper::arcAddMessage("danger", "Invalid username and/or password");
    Log::createLog("warning", "user", "Incorrect password: " . system\Helper::arcGetPostData("email"));
}