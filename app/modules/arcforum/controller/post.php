<?php

if (system\Helper::arcIsAjaxRequest()) {

    $post = new ForumPost();
    $post->categoryid = $_POST["id"];
    $post->content = htmlentities($_POST["post"]);
    $post->subject = $_POST["subject"];
    $post->posterid = system\Helper::arcGetUser()->id;
    $post->update();

    system\Helper::arcReturnJSON([]);

}