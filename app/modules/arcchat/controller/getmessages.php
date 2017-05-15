<?php

if (system\Helper::arcIsAjaxRequest()) {
    $session = ChatSession::getByID($_POST["sessionid"]);
    $html = "";

    $seen = [];
        

    if (isset($_SESSION["chat_seenids"])) {
        $seen = $_SESSION["chat_seenids"];
    }

        $messages = $session->getItems();

    foreach ($messages as $message) {
        $found = false;
        foreach ($seen as $id) {
            if ($message->id == $id) {
                $found = true;
            }
        }

        if ($found == false) {
            $seen[] = $message->id;
            $user = User::getByID($message->userid);
            if ($user->id == 0) {
                $user->firstname = "Chat";
                $user->lastname = "System";
            }
            $html .= "<div class=\"row message-bubble\">"
            . "<p class=\"card-text text-muted\">" . $user->getFullname() . "<br />"
            . system\Helper::arcConvertTime($message->event) . "</p>"
            . "<span>" . $message->message . "</span>"
            . "</div>";
        }
    }

    $_SESSION["chat_seenids"] = $seen;

    system\Helper::arcReturnJSON(["html" => $html, "status" => $session->status]);
}
