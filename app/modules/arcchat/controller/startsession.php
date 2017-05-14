<?php

if (system\Helper::arcIsAjaxRequest()) {

    $session = new ChatSession();
    $session->guestid = system\Helper::arcGetUser()->id;
    $session->update();

    $welcome = new ChatEntry();
    $welcome->sessionid = $session->id;
    $welcome->userid = 0;
    $welcome->message = "Welcome, an agent will be with you shortly.";
    $welcome->update();

    system\Helper::arcReturnJSON(["session" => $session->id, "event" => system\Helper::arcConvertDatetime($session->event)]);     

}