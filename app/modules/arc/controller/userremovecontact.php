<?php

if (system\Helper::arcIsAjaxRequest()) {
    $contact = CRMUserContact::getByID($_POST["id"]);   
    $contact->delete();
    system\Helper::arcAddMessage("success", "Contact deleted");
    system\Helper::arcReturnJSON([]);
}