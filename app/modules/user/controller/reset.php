<?php

if (system\Helper::arcIsAjaxRequest() == true) {
   $user = User::getByEmail($_POST["emailf"]);
   
   // valid user
   if ($user->id > 0) {
       system\Helper::arcAddMessage("danger", "NOT IMPLEMENTED");
   } else {
       system\Helper::arcAddMessage("danger", "Email address is not registered");
       Log::createLog("danger", "user", "Request to reset unknown email address '" . $_POST["emailf"] . "'.");
   }
}