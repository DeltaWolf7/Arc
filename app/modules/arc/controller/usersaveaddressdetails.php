<?php

if (system\Helper::arcIsAjaxRequest()) {
    $address = CRMUserAddress::getByID($_POST["id"]);
    $user = system\Helper::arcGetUser();
    if ($address->id == 0) {
        $address = new CRMUserAddress();
        $address->userid = $user->id;
    }
    $address->addresslines = $_POST["addresslines"];
    $address->county = $_POST["county"];
    $address->postcode = $_POST["postcode"];
    $address->country = $_POST["country"];
    $address->isbilling = $_POST["isbilling"];
    if ($address->isbilling == 1) {
        CRMUserAddress::clearBillingByUserID($user->id);
    }
    $address->isdelivery = $_POST["isdelivery"];
    if ($address->isdelivery == 1) {
        CRMUserAddress::clearDeliveryByUserID($user->id);
    }
    $address->update();
    
    system\Helper::arcAddMessage("success", "Address updated");
    system\Helper::arcReturnJSON();
}