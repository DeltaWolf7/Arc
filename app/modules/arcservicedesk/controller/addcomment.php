<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    
    if ($_POST["comment"] == "") {
        system\Helper::arcAddMessage("danger", "Please provide comment");
        system\Helper::arcReturnJSON(["success" => "false"]);
        return;
    }

    $comment = new ArcServiceDeskComment();
    $comment->description = $_POST["comment"];
    $comment->ticketid = $_POST["ticketid"];
    $user = system\Helper::arcGetUser();
    $comment->userid = $user->id;
    $comment->update();

    system\Helper::arcAddMessage("success", "Comment added successfully");
    system\Helper::arcReturnJSON(["success" => "true"]);
}