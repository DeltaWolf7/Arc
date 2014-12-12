<?php

if (count($_POST) > 0) {
    if (empty($_POST["email"])) {
        echo "danger|<strong>Email address</strong> must be provided";
        return;
    }

    $user = \User::getByEmail($_POST["email"]);

    if ($user->id == 0) {
        echo "danger|No user found matching that email address";
        return;
    }
       
    $to[$user->firstname . " " . $user->lastname] = $user->email;

    $message = "Hi " . $user->firstname . ", <br />";
    $message .= "You or someone else has requested a password reset.";
    $message .= " If you have not requested a reset, ignore this email";
    $message .= " else click the link below to reset your password.<br /><br />";

    $message .= "<a href=\"" . system\Helper::arcGetPath() . "login/reset/" . $user->id . "/" . $user->email . "\">Reset Password</a>";
    
    $mail = system\Helper::arcSendMail($to, "Password Reset Request", $message);
    
    if ($mail == null) {
        echo "success|Password reset request sent.";
    } else {
        echo "danger|Unable to send message, check settings.";
    }
}
