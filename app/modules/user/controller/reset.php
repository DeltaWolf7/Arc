<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $user = User::getByEmail($_POST["email"]);

    // valid user
    if ($user->id > 0) {

        $password = md5(uniqid($user->email, true));
        $user->setPassword($password);
        $user->update();

        $message = "You or someone else has requested a password reset.<br />"
                . "Your new password is '" . $password . "'.";

        $mail = new Mail();
        $mail->Send($user->email, "Password Reset Request", $message, true);

        system\Helper::arcAddMessage("success", "Password reset, please check your email.");
        Log::createLog("warning", "user", "Password reset request '" . $_POST["email"] . "'.");
    } else {
        system\Helper::arcAddMessage("danger", "Email address is not registered");
        Log::createLog("danger", "user", "Request to reset unknown email address '" . $_POST["email"] . "'.");
    }
}