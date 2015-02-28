<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if (empty($_POST["email"])) {
        system\Helper::arcAddMessage("danger", "Email address must be provided");
        return;
    }

    $user = \User::getByEmail($_POST["email"]);

    if ($user->id == 0) {
        system\Helper::arcAddMessage("danger", "No user found matching that email address");
        Log::createLog("Password reset, user not found: " . $_POST["email"]);
        return;
    }
       
    $to[$user->firstname . " " . $user->lastname] = $user->email;

    $message = "Hello " . $user->firstname . ", <br /><br />";
    $message .= "You or someone else has requested a password reset.";
    $message .= " If you have not requested a reset you can ignore this email";
    $message .= " or click the link below to reset your password.<br /><br />";

    $message .= "<a href=\"" . system\Helper::arcGetModulePath() . "reset/" . base64_encode($user->id . "|" . $user->email) . "\">Reset Password</a>";
    
    $mail = system\Helper::arcSendMail($to, "Password Reset Request", $message);
    
    if ($mail) {
        system\Helper::arcAddMessage("success", "Password reset request has been emailed");
        Log::createLog("Password reset sent: " . $_POST["email"]);
    }
}
