<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "submit") {      
        
       $booking = new Skype();
       $booking->userid = $_POST["id"];
       $booking->status = 0;
       
       $date = explode(" ", $_POST["date"]);
       
       $booking->date = $date[2] . "-" . $date[1] . "-" . $date[0];
       $booking->time = $date[3] . ":" . $date[4] . ":00";
       $booking->update();
       
       system\Helper::arcAddMessage("success", "Thank you for your booking. We will be in contact soon to confirm.");
    }
}
