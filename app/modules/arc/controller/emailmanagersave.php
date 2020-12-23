<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    $email = Email::getByID($_POST["id"]);
    $email->text = htmlentities($_POST["html"]);
    $email->subject = $_POST["subject"];
    $email->key = strtoupper($_POST["key"]);
    
    
    if (empty($email->key)) {
        system\Helper::arcAddMessage("danger", "Email must have a key");
        system\Helper::arcReturnJSON(["status" => "failed"]);
        return;
    }

    if (empty($email->subject)) {
        system\Helper::arcAddMessage("danger", "Email must have a subject");
        system\Helper::arcReturnJSON(["status" => "failed"]);
        return;
    }

    if (empty($email->text)) {
        system\Helper::arcAddMessage("danger", "Email must have a body");
        system\Helper::arcReturnJSON(["status" => "failed"]);
        return;
    }
    
    $email->update();
    system\Helper::arcAddMessage("success", "Email saved");
    system\Helper::arcReturnJSON(["status" => "success"]);
}