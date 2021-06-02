<?php

if (system\Helper::arcIsAjaxRequest()) {
    
    $apikey = SystemSetting::getByKey("APIKEY", $_POST["userid"]);
    if ($apikey->id == 0) {
        
        $salt = mt_rand();
        $signature = hash_hmac('sha256', $salt, ARCIVKEYPAIR, true);
        $encodedSignature = base64_encode($signature);
        
        $apikey->value = $encodedSignature;
        $apikey->update();
    }

    system\Helper::arcAddMessage("success", "User API key created");
    system\Helper::arcReturnJSON();
}