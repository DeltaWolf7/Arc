<?php

if (system\Helper::arcIsAjaxRequest()) {

    $category = ForumCategory::getByID($_POST["category"]);
    $category->delete();

    $posts = ForumPost::getPosts($_POST["category"]);
    foreach ($posts as $post) {
        $post->delete();

        $replies = ForumPost::getReplies($post->id);

        foreach ($replies as $reply) {
            $reply->delete();
        }
    }

    system\Helper::arcReturnJSON();

}