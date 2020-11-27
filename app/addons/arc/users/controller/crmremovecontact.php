<?php

if (system\Helper::arcIsAjaxRequest()) {
    $contact = CRMUserContact::getByID($_POST["contactid"]);   
    $contact->delete();
    system\Helper::arcAddMessage("success", "Contact deleted");
    system\Helper::arcReturnJSON();
}