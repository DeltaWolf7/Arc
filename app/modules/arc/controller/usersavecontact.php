<?php

if (system\Helper::arcIsAjaxRequest()) {
    $contact = ArcCRMUserContact::getByID($_POST["id"]);
    if ($contact->id == 0) {
        $contact = new ArcCRMUserContact();
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
}