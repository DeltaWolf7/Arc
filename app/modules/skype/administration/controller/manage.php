<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "manage") {      
        
       $session = new Skype();
       $session->getByID($_POST["id"]);
       
       system\Helper::arcReturnJSON(["html" => "TEST"]);
    }
}
