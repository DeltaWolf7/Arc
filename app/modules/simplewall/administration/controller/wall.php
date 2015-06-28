<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "getdata") {
        $posts = Post::getLatest(100);
        $html = "";
        foreach ($posts as $post) {     
            $html .= "<div class=\"panel panel-default\"><div class=\"panel-heading\">";
            $html .= $post->user . " said on " . $post->posted . "</div><div class=\"panel-body\">";
            $html .= $post->content . "</div></div>";       
        }
        system\Helper::arcReturnJSON(["html" => $html]);
    } elseif ($_POST["action"] == "send") {
        $user = new User();
        $user->getByID($_POST["id"]);
        $post = new Post();
        $post->user = $user->getFullname();
        $post->userid = $user->id;
        $post->content = htmlentities($_POST["content"]);
        $post->update();
        system\Helper::arcAddMessage("success", "Posted");
    }
}

