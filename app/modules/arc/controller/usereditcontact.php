<?php

if (system\Helper::arcIsAjaxRequest()) {
    $contact = ArcCRMUserContact::getByID($_POST["id"]);
    system\Helper::arcReturnJSON(["name" => $contact->name, "title" => $contact->title,
         "email" => $contact->email, "phone" => $contact->phone]);
}