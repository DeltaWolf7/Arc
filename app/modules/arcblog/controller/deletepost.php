<?php

    if (system\Helper::arcIsAjaxRequest()) {

        $blog = Blog::getByID($_POST["id"]);
        $blog->delete();

        $currentRoute = Router::getRoute("blog/post/" . $blog->seourl);
        $currentRoute->delete();

        system\Helper::arcAddMessage("success", "Blog post deleted");
        system\Helper::arcReturnJSON([]);

    }