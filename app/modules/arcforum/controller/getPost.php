<?php

if (system\Helper::arcIsAjaxRequest()) {

    $html = "";

    $post = ForumPost::getByID($_POST["id"]);

    $html .= "<tr><td><h4>{$post->subject}</h4></td></tr>";

    $user = User::getByID($post->posterid);
    $html .= "<tr class=\"table-info\"><td class=\"text-right\">"
        . " <small><i class=\"fa fa-clock-o\"></i> " . system\Helper::arcConvertDateTime($post->posted)
        . " <i class=\"fa fa-user\"></i> " . $user->getFullname() . "</small></td></tr>"
        . "<tr><td style=\"word-wrap: break-word;min-width: 160px;max-width: 160px;\">"
        . html_entity_decode($post->content)
        . "</td></tr>";

    $replies = ForumPost::getReplies($_POST["id"]);
    foreach ($replies as $reply) {
        $user = User::getByID($reply->posterid);
        $html .= "<tr class=\"table-info\"><td class=\"text-right\">"
        . " <small><i class=\"fa fa-clock-o\"></i> " . system\Helper::arcConvertDateTime($reply->posted)
        . " <i class=\"fa fa-user\"></i> " . $user->getFullname() . "</small></td></tr>"
        . "<tr><td>"
        . html_entity_decode($reply->content)
        . "</td></tr>";
    }

    $html .= "<tr><td class=\"text-right\">";

    if ($_POST["id"] != 0) {
        $html .= "<button class=\"btn btn-secondary\" onclick=\"getCategory({$post->categoryid})\">< Back</button> ";
    }

    if (system\Helper::arcGetUser()->id == $post->posterid || system\Helper::arcIsUserAdmin()) {
        $html .= "<button class=\"btn btn-danger\" onclick=\"deletePost({$_POST["id"]})\">Delete</button> ";
    }
    
    $html .= "<button class=\"btn btn-primary\" onclick=\"reply({$_POST["id"]}, {$post->categoryid})\">Replay</button>"
        . "</td></tr>";

    system\Helper::arcReturnJSON(["html" => $html]);
}