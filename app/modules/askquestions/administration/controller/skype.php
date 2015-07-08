<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "confirm") {
        $skype = new Skype();
        $skype->getByID($_POST["id"]);
        $skype->confirmed = true;
        $skype->update();
        
        $user = new User();
        $user->getByID($skype->userid);
        
        system\Helper::arcSendMail("office@mrfelevenplustuition.co.uk", "CONFIRMED:: Skype booking: {$user->getFullname()}", 
                "Hi,\n\nThe Skype session booked for " . $skype->booked . " has been set to CONFIRMED." . PHP_EOL . PHP_EOL . "Thanks", false);     
        system\Helper::arcSendMail($user->email, "CONFIRMED:: Skype booking: {$user->getFullname()}", 
                "Hi,"  . PHP_EOL  . PHP_EOL .  "The Skype session booked for " . $skype->booked . " has been set to CONFIRMED." . PHP_EOL . PHP_EOL . "Thanks", false); 
        
    } elseif ($_POST["action"] == "unconfirm") {
        $skype = new Skype();
        $skype->getByID($_POST["id"]);
        $skype->confirmed = false;
        $skype->update();
        
        $user = new User();
        $user->getByID($skype->userid);
        
        system\Helper::arcSendMail("office@mrfelevenplustuition.co.uk", "UNCONFIRMED:: Skype booking: {$user->getFullname()}", 
                "Hi,\n\nThe Skype session booked for " . $skype->booked . " has been set to UNCONFIRMED.\n\nThanks", false);     
        system\Helper::arcSendMail($user->email, "UNCONFIRMED:: Skype booking: {$user->getFullname()}",  
                "Hi,\n\nThe Skype session booked for " . $skype->booked . " has been set to UNCONFIRMED.\n\nThanks", false);
        
    } elseif ($_POST["action"] == "delete") {
        $skype = new Skype();
        $skype->delete($_POST["id"]);
    }
}