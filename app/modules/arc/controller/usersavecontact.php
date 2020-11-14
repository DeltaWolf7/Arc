<?php

if (system\Helper::arcIsAjaxRequest()) {
    $contact = CRMUserContact::getByID($_POST["id"]);
    if ($contact->id == 0) {
        $contact = new CRMUserContact();
        $contact->userid = $_POST["userid"];
    }
    
    if (empty($_POST["name"])) {
        system\Helper::arcAddMessage("danger", "Contact name cannot be empty");
        return;
    }
    
    $contact->name = ucwords(strtolower($_POST["name"]));
    $contact->title = ucwords(strtolower($_POST["title"]));
    $contact->email = strtolower($_POST["email"]);
    $contact->phone = $_POST["phone"];

    $contact->update();
    system\Helper::arcAddMessage("success", "Contact saved");
    system\Helper::arcReturnJSON();
}