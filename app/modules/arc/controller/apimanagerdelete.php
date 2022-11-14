<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    
    $newKey = APIKey::getByID($_POST["id"]);
    $newKey->delete();

    system\Helper::arcAddMessage("success", "API key deleted");
    system\Helper::arcReturnJSON();
}