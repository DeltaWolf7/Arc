<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "send") {      
        $text = $_POST["day"] . " @ " . $_POST["time"];
        
        $skype = Skype::getByDate($text);
        if ($skype->id != 0) {
            system\Helper::arcAddMessage("danger", "Time slot occupied, please choose another");
            return;
        }
        $skype = new Skype();
        $skype->booked = $text;
        $skype->userid = $_POST["id"];
        $skype->update();
        
        $user = new User();
        $user->getByID($_POST["id"]);
        system\Helper::arcSendMail("office@mrfelevenplustuition.co.uk", "Skype booking: {$user->getFullname()}", $skype->booked);
        
        system\Helper::arcSendMail($user->email, "Skype booking: {$user->getFullname()}", $skype->booked);
        
        system\Helper::arcAddMessage("success", "Slot booked, thank you.");
    }
}
