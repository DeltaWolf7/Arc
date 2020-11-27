<?php

if (system\Helper::arcIsAjaxRequest()) {
    $contact = CRMUserContact::getByID($_POST["contactid"]);
    system\Helper::arcReturnJSON(["name" => $contact->name, "title" => $contact->title,
         "email" => $contact->email, "phone" => $contact->phone, "id" => $contact->id]);
}