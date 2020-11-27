<?php

if (system\Helper::arcIsAjaxRequest()) {
    $address = CRMUserAddress::getByID($_POST["addressid"]);
    if ($address->id == 0) {
        $address = new CRMUserAddress();
        $address->userid = $_POST["addressuserid"];
    }
    $address->addresslines = $_POST["addresslines"];
    $address->county = $_POST["county"];
    $address->postcode = $_POST["postcode"];
    $address->country = $_POST["country"];

    if (isset($_POST["isbilling"])) {
        $address->isbilling = 1;
        CRMUserAddress::clearBillingByUserID($address->userid);
    }

    if (isset($_POST["isdelivery"])) {
        $address->isdelivery = 1;
        CRMUserAddress::clearDeliveryByUserID($address->userid);
    }  

    $address->update();
    
    system\Helper::arcAddMessage("success", "Address updated");
    system\Helper::arcReturnJSON();
}