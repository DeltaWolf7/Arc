<?php

if (system\Helper::arcIsAjaxRequest()) {
    $company = Company::getByID($_POST["id"]);
    
    $users = $company->getUsers();
    if (count($users) > 0) {
        system\Helper::arcAddMessage("danger", "Unable to remove company with users associated");
        return;
    }
    
    $company->delete($_POST["id"]);
    system\Helper::arcAddMessage("success", "Company deleted");
}