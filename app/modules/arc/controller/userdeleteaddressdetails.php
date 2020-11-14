<?php

if (system\Helper::arcIsAjaxRequest()) {
    $address = CRMUserAddress::getByID($_POST["id"]);
    $address->delete();
      
    system\Helper::arcAddMessage("success", "Address deleted");
    system\Helper::arcReturnJSON();
}