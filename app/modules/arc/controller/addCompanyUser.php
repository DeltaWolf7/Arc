<?php

if (system\Helper::arcIsAjaxRequest()) {
    
    $user = User::getByID($_POST["userid"]); 
    
    if ($user->id == 0) {
        system\Helper::arcAddMessage("danger", "User must be saved before group can be modified.");
        return;
    }
    
    if (empty($_POST["company"])) {
        system\Helper::arcAddMessage("danger", "Invalid company");
        return;
    }
    
    $user->addToCompany($_POST["company"]);
    
    system\Helper::arcAddMessage("success", "User associated with company");
}