<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "getdata") {
        $posts = Post::getLatest(30);
        $html = "";
        foreach ($posts as $post) {     
            $html .= "<div class=\"panel panel-default\"><div class=\"panel-heading\">";
            $html .= $post->user . " said on " . $post->posted . "</div><div class=\"panel-body\">";
            $html .= $post->content . "</div></div>";       
        }
        echo utf8_encode(json_encode(["html" => $html]));
    } elseif ($_POST["action"] == "send") {
        $user = new User();
        $user->getByID($_POST["id"]);
        $post = new Post();
        $post->user = $user->getFullname();
        $post->userid = $user->id;
        $post->content = htmlentities($_POST["content"]);
        $post->update();
        echo utf8_encode(json_encode(["status" => "success", "data" => "Posted"]));
    }
}

