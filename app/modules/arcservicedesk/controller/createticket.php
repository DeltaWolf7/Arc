<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    
    $ticket = new ArcServiceDeskTicket();
    $ticket->summary = $_POST["summary"];
    $ticket->description = $_POST["description"];

    $user = system\Helper::arcGetUser();
    $ticket->userid = $user->id;
    $ticket->update();

    system\Helper::arcAddMessage("success", "New ticket created successfully");
    system\Helper::arcReturnJSON();
}