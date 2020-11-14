<?php

if (system\Helper::arcIsAjaxRequest()) {
    $address = CRMUserAddress::getByID($_POST["id"]);   
    system\Helper::arcReturnJSON(["addresslines" => $address->addresslines, "county" => $address->county,
            "postcode" => $address->postcode, "country" => $address->country, "isbilling" => $address->isbilling,
             "isdelivery" => $address->isdelivery]);
}