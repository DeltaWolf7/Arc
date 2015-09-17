<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "submit") {

        $booking = new Skype();
        $booking->userid = $_POST["id"];
        $booking->status = 0;
        $booking->notes = "";

        $date = explode(" ", $_POST["date"]);

        $booking->date = $date[2] . "-" . $date[1] . "-" . $date[0];
        $booking->time = $date[3] . ":" . $date[4] . ":00";


        $haveBooking = Skype::getByDateAndTime($booking->date, $booking->time);
        if (count($haveBooking) > 0) {
            $have = false;
            foreach ($haveBooking as $bk) {
                if ($bk->status == 1) {
                    $have = true;
                    break;
                }
            }
            if ($have == true) {
                system\Helper::arcAddMessage("danger", "Sorry, this slot has already been confirmed for another user.");
                return;
            }
        }


        $booking->update();

        system\Helper::arcAddMessage("success", "Thank you for your booking. We will be in contact soon to confirm.");
    }
}
