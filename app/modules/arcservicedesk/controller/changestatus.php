<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    
    $ticket = ArcServiceDeskTicket::getByID($_POST["ticketid"]);
    $currentStatus = $ticket->status;

    if ($ticket->status == $_POST["status"]) {
        system\Helper::arcAddMessage("warning", "No change made");
        system\Helper::arcReturnJSON();
        return;
    }
    
    $ticket->status = $_POST["status"];
    $ticket->update();

    $user = system\Helper::arcGetUseR();

    $comment = new ArcServiceDeskComment();
    $comment->description = $user->getFullname() . " changed ticket status from '" . $currentStatus . "' to '" . $ticket->status . "'.";
    $comment->ticketid = $ticket->id;
    $comment->userid = 0;
    $comment->update();

    system\Helper::arcAddMessage("success", "Ticket status updated successfully");
    system\Helper::arcReturnJSON();
}