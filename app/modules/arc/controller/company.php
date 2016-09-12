<?php

if (system\Helper::arcIsAjaxRequest()) {
    $company = Company::getByID($_POST["id"]);   
    system\Helper::arcReturnJSON(["name" => $company->name]);
}