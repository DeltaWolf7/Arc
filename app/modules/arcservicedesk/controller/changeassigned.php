<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    
    $user = system\Helper::arcGetUser();
    $assigned = User::getByID($_POST["assigned"]);

    $ticket = ArcServiceDeskTicket::getByID($_POST["ticketid"]);

    if ($ticket->assignedto == $assigned->id) {
        system\Helper::arcAddMessage("warning", "No change made");
        system\Helper::arcReturnJSON();
        return;
    }

    $ticket->assignedto = $assigned->id;
    $ticket->update();

    $comment = new ArcServiceDeskComment();
    $comment->description = $user->getFullname() . " assigned ticket to " . $assigned->getFullname();
    $comment->ticketid = $ticket->id;
    $comment->userid = 0;
    $comment->update();

    system\Helper::arcAddMessage("success", "Ticket assigned.");
    system\Helper::arcReturnJSON();
}