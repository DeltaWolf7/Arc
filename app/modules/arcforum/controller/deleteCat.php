<?php

if (system\Helper::arcIsAjaxRequest()) {

    $category = ForumCategory::getByID($_POST["category"]);
    $category->delete($category->id);

    $posts = ForumPost::getPosts($_POST["category"]);
    foreach ($posts as $post) {
        $post->delete($post->id);

        $replies = ForumPost::getReplies($post->id);

        foreach ($replies as $reply) {
            $reply->delete($reply->id);
        }
    }

    system\Helper::arcReturnJSON([]);

}