<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if (empty($_POST["email"])) {
        system\Helper::arcAddMessage("danger", "Email address must be provided");
        return;
    }

    $user = \User::getByEmail($_POST["email"]);

    if ($user->id == 0) {
        system\Helper::arcAddMessage("danger", "No user found matching that email address");
        Log::createLog("warning", "user", "Password reset, user not found: " . $_POST["email"]);
        return;
    }

    $to = $user->email;

    $message = "<html><body>Hello " . $user->firstname . ", <br /><br />";
    $message .= "You or someone else has requested a password reset.";
    $message .= " If you have not requested a reset you can ignore this email";
    $message .= " or click the link below to reset your password.<br /><br />";

    $message .= "<a href=\"" . system\Helper::arcGetModulePath() . "reset/" . base64_encode($user->id . "|" . $user->email)
            . "\">Reset Password</a></body></html>";

    $mail = new Mail();
    $mail->Send($to, "Password Reset Request", $message, $html);
    
    system\Helper::arcAddMessage("success", "Password reset link has been sent to your Email");
    Log::createLog("warning", "user", "Password reset sent: " . $_POST["email"]);
} else {
    system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath("user") . "js/forgot.js");
}
