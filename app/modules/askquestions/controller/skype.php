<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "send") {
        $month = date("m");
        $year = date("y");
        
        
        $skype = Skype::getByDateTime($_POST["day"] . "-" . $month . "-" . $year . " @ " . $_POST["time"]);
        if ($skype->id != 0) {
            system\Helper::arcAddMessage("danger", "Time slot occupied, please choose another");
            return;
        }
        $skype = new Skype();
        $skype->booked = $_POST["day"] . "-" . $month . "-" . $year . " @ " . $_POST["time"];
        $skype->userid = $_POST["id"];
        $skype->update();
        
        $user = new User();
        $user->getByID($_POST["id"]);
        system\Helper::arcSendMail("office@mrfelevenplustuition.co.uk", "Skype booking: {$user->getFullname()}", $skype->booked);
        
        system\Helper::arcAddMessage("success", "Slot booked, thank you.");
    }
}
