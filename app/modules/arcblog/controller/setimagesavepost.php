<?php


if (system\Helper::arcIsAjaxRequest() == true) {  
    if ($_POST["action"] == "setimage") {
        $post = new Blog();
        $post->getByID($_POST["id"]);
        if ($post->id != 0) {
            if (empty($_POST["image"])) {
                $post->image = "";
            } else {
                $post->image = $_POST["image"];
            }
        }
        $post->update();
    } elseif ($_POST["action"] == "savepost") {
        
    }
}