<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $email = Email::getByID($_POST["emailid"]);
    $user = system\Helper::arcGetUser();
    
    $message = html_entity_decode($email->text);
    $message = str_replace("{password}", "DUMMYTESTDATA", $message);

    $mail = new Mail();
    $mail->Send($user->email, $email->subject , $message, true);
   
    system\Helper::arcAddMessage("success", "Email test sent.");
    system\Helper::arcReturnJSON(["status" => "success"]);
}