<?php

if (system\Helper::arcIsAjaxRequest()) {
       $blog = new Blog();
        $blog->getByID($_POST["id"]);
        
        $blog->content = $_POST["content"];
        $blog->date = $_POST["date"];
        $blog->title = $_POST["title"];
        $blog->seourl = $_POST["seourl"];
        $blog->tags = $_POST["tags"];
        
        $user = new User();
        $user->getByID($_POST["poserid"]);
        $blog->poster = $user->getFullname();
        
        $blog->update();
        system\Helper::arcAddMessage("success", "Blog post saved");
}
