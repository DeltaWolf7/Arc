<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "manage") {      
        
       $session = new Skype();
       $session->getByID($_POST["id"]);
       
       $user = new User();
       $user->getByID($session->userid);
       
       $html = "<table class=\"table\">";
       $html .= "<tr><td>Name</td><td>" . $user->getFullname() . "</td></tr>";
       $html .= "<tr><td>Date</td><td>" . $session->date . "</td></tr>";
       $html .= "<tr><td>Time</td><td>" . $session->time . "</td></tr>";
       $html .= "<tr><td>Status</td><td><select class=\"form-control\" id=\"statusid\">";
       $html .= "<option value=\"0\"";
       if ($session->status == 0) {
           $html .= " selected";
       }
       $html .= ">Unconfirmed</option>";
       $html .= "<option value=\"1\"";
       if ($session->status == 1) {
           $html .= " selected";
       }
       $html .= ">Confirmed</option>";
       $html .= "<option value=\"2\"";
       if ($session->status == 2) {
           $html .= " selected";
       }
       $html .= ">Complete</option>";
       $html .= "<option value=\"3\"";
       if ($session->status == 3) {
           $html .= " selected";
       }
       $html .= ">Cancelled</option>";
       $html .= "</select></td></tr>";
       $html .= "<tr><td>Notes</td><td>";
       $html .= "<textarea id=\"notes\" class=\"form-control\" rows=\"4\" cols=\"50\">" . $session->notes . "</textarea>";
       $html .= "</td></tr>";
       $html .= "</table>";
       
       system\Helper::arcReturnJSON(["html" => $html]);
    } elseif ($_POST["action"] == "savesession") {
        
       $session = new Skype();
       $session->getByID($_POST["id"]);
       $session->status = $_POST["statusid"];
       $session->notes = $_POST["notes"];
       $session->update();
       
       $user = new User();
       $user->getByID($session->userid);
       
       $stat = "";
       switch ($session->status) {
           case 0:
               $stat = "unconfirmed";
               break;
           case 1:
               $stat = "confirmed";
               break;
           case 2:
               $stat = "complete";
               break;
           case 3:
               $stat = "cancelled";
               break;
       }
       
       $message = "Hi " . $user->getFullname() . ",\n\nYour Skype booking for the {$session->date}"
           . " at {$session->time} has been updated.\n\nNew Status: {$stat}.\n\nKind regards,\n\nThe Team";
       
       system\Helper::arcSendMail($user->email, "Skype Status Update", $message);
       
       system\Helper::arcAddMessage("success", "Session information saved.");      
    }
}
