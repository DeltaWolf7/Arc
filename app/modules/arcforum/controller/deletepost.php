<?php

if (system\Helper::arcIsAjaxRequest()) {

    $post = ForumPost::getByID($_POST["post"]);
    $post->delete();

    $posts = ForumPost::getReplies($_POST["post"]);
    foreach ($posts as $p) {
        $p->delete();
    }

    system\Helper::arcReturnJSON();
}