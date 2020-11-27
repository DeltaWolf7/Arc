<?php

if (system\Helper::arcIsAjaxRequest()) {
    $contact = CRMUserContact::getByID($_POST["contactid"]);
    if ($contact->id == 0) {
        $contact = new CRMUserContact();
        $contact->userid = $_POST["contactuserid"];
    }
    
    if (empty($_POST["contactname"])) {
        system\Helper::arcAddMessage("danger", "Contact name cannot be empty");
        system\Helper::arcReturnJSON(["error" => true]);
        return;
    }
    
    $contact->name = ucwords(strtolower($_POST["contactname"]));
    $contact->title = ucwords(strtolower($_POST["contacttitle"]));
    
    if (!filter_var(strtolower($_POST["contactemail"]), FILTER_VALIDATE_EMAIL)) {
        system\Helper::arcAddMessage("danger", "Invalid email address");
        system\Helper::arcReturnJSON(["error" => true]);
        return;
    }
    
    $contact->email = strtolower($_POST["contactemail"]);
    $contact->phone = $_POST["contactphone"];

    $contact->update();
    system\Helper::arcAddMessage("success", "Contact saved");
    system\Helper::arcReturnJSON();
}