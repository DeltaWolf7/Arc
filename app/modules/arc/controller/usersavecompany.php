<?php

if (system\Helper::arcIsAjaxRequest()) {
    $company = Company::getByID($_POST["id"]);
    $company->name = ucwords(strtolower($_POST["name"]));
    
    if (empty($_POST["name"])) {
        system\Helper::arcAddMessage("danger", "Company name cannot be empty");
        return;
    }
    
    $test = Company::getByName($_POST["name"]);
    if ($test->id != $company->id && $test->id != 0) {
        system\Helper::arcAddMessage("danger", "Company with this name already exists");
        return;
    }
    
    $company->update();
    system\Helper::arcAddMessage("success", "Company saved");
}