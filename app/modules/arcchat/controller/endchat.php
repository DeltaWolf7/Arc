<?php

if (system\Helper::arcIsAjaxRequest()) {

    $session = ChatSession::getByID($_POST["sessionid"]);
    $session->status = "Closed";
    $session->update();

    $close = new ChatEntry();
    $close->sessionid = $session->id;
    $close->userid = 0;
    $close->message = "Session terminated by agent " . system\Helper::arcGetUser()->getFullname();
    $close->update();

    system\Helper::arcAddMessage("success", "Chat session terminated");
    system\Helper::arcReturnJSON([]);

}