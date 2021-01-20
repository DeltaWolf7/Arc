<?php


if (system\Helper::arcIsAjaxRequest()) {  
        $post = Blog::getByID($_POST["id"]);
        if ($post->id != 0) {
            if (empty($_POST["image"])) {
                $post->image = "";
            } else {
                $post->image = $_POST["image"];
            }
        }
        $post->update();

        system\Helper::arcReturnJSON([]);
}