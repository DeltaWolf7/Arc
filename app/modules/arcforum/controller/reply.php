<?php

if (system\Helper::arcIsAjaxRequest()) {

    $post = new ForumPost();
    $post->categoryid = $_POST["id"];
    $post->content = htmlentities($_POST["post"]);
    $post->subject = "REPLY";
    $post->posterid = system\Helper::arcGetUser()->id;
    $post->parentid = $_POST["parent"];
    $post->update();

    system\Helper::arcReturnJSON([]);

}