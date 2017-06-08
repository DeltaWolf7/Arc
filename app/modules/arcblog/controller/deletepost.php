<?php

    if (system\Helper::arcIsAjaxRequest()) {

        $blog = Blog::getByID($_POST["id"]);
        $blog->delete($_POST["id"]);

        $currentRoute = Router::getRoute("blog/post/" . $blog->seourl);
        $currentRoute->delete($currentRoute->id);

        system\Helper::arcAddMessage("success", "Blog post deleted");
        system\Helper::arcReturnJSON(["message" => "OK"]);

    }