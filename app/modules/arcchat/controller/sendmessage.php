<?php

if (system\Helper::arcIsAjaxRequest()) {

    $session = ChatSession::getByID($_POST["sessionid"]);

    // check if this is the session starter, if not add them
    $sender = system\Helper::arcGetUser();
    if ($sender->id != $session->guestid) {
        
        $session->addAgent($sender->id);

    }

    $message = new ChatEntry();
    $message->sessionid = $session->id;
    $message->userid = $sender->id;
    $message->message = $_POST["message"];
    $message->update();

    system\Helper::arcReturnJSON([]);

}