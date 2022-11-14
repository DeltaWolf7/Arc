<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    
    $newKey = new APIKey();
    $newKey->userid = $_POST["userid"];
    $newKey->apikey = $_POST["key"];
    $newKey->secrethash = APIKey::hashSecret($_POST["secret"]);
    $newKey->update();

    system\Helper::arcAddMessage("success", "API key created");
    system\Helper::arcReturnJSON();
}