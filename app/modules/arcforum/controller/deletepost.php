<?php

if (system\Helper::arcIsAjaxRequest()) {

    $post = ForumPost::getByID($_POST["post"]);
    $post->delete($_POST["post"]);

    $posts = ForumPost::getReplies($_POST["post"]);
    foreach ($posts as $p) {
        $p->delete($p->id);
    }

    system\Helper::arcReturnJSON([]);
}