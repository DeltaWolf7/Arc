<?php

if (system\Helper::arcIsAjaxRequest()) {
    $email = Email::getByID($_POST["id"]);
    system\Helper::arcReturnJSON(["subject" => $email->subject, "text" => html_entity_decode($email->text),
        "protected" => $email->protected, "key" => $email->key]);
}