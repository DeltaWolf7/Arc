<?php

if (system\Helper::arcIsAjaxRequest()) {
    
    $user = User::getByID($_POST["userid"]);
    $user->removeFromCompany($_POST["company"]);
    
    system\Helper::arcAddMessage("success", "User removed from company");
    
}
