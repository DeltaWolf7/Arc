<?php

if (system\Helper::arcGetURLData("action") == null) {
    system\Helper::arcOverrideView("default", true);
}

if (isset($_POST["action"])) {  
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
        $post = new Blog();
        $post->getByID($_POST['id']);
        $post->categoryid = $_POST['categoryid'];
        $post->content = $_POST['editor'];
        $post->posterid = $_POST['poster'];
        $post->seourl = $_POST['seourl'];
        $post->tags = $_POST['tags'];
        $post->title = $_POST['title'];
        $post->update();
        echo "success|Post saved";
    }
}