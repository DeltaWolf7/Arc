<?php

if (system\Helper::arcIsAjaxRequest()) {
    $user = User::getByEmail($_POST["emailf"]);

    // valid user
    if ($user->id > 0) {

        $password = md5(uniqid($user->email, true));
        $user->setPassword($password);
        $user->update();

        $messageS = Email::getByKey("ARC_PASSWORD_RESET");

        $message = html_entity_decode($messageS->text);
        $message = str_replace("{password}", $password, $message);

        $mail = new Mail();
        $mail->Send($user->email, $messageS->subject, $message, true);

        system\Helper::arcAddMessage("success", "Password reset, please check your email.");
        Log::createLog("warning", "user", "Password reset request '" . $_POST["emailf"] . "'.");
        system\Helper::arcReturnJSON();
    } else {
        system\Helper::arcAddMessage("danger", "Email address is not registered");
        Log::createLog("danger", "user", "Request to reset unknown email address '" . $_POST["emailf"] . "'.");
        system\Helper::arcReturnJSON();
    }
}