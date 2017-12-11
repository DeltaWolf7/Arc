<?php

if (system\Helper::arcIsAjaxRequest()) {
        $blog = Blog::getByID($_POST["id"]);  
        $blog->content = $_POST["content"];
        $blog->date = system\Helper::arcConvertDateTimeToSql($_POST["date"]);

        if (empty($_POST["title"])) {
            system\Helper::arcAddMessage("danger", "Please provide a post title");
            system\Helper::arcReturnJSON(["error" => "Please provide a post title"]);
            return;
        }

        $blog->title = $_POST["title"];

        if (empty($_POST["seourl"])) {
            system\Helper::arcAddMessage("danger", "Please provide post SEO Url");
            system\Helper::arcReturnJSON(["error" => "Please provide post SEO Url"]);
            return;
        }

        $currentRoute = Router::getRoute("blog/post/" . $blog->seourl);

        $seocheck = Blog::getBySEOUrl($_POST["seourl"]);
        if ($seocheck->id != 0 && $seocheck->id != $blog->id) {
            system\Helper::arcAddMessage("danger", "SEO Url already in use by " . $seocheck->title);
            system\Helper::arcReturnJSON(["error" => "SEO Url already in use by " . $seocheck->title]);
            return;
        }
       
        if (Router::isValid($_POST["seourl"])) {
            $blog->seourl = strtolower($_POST["seourl"]);
            $currentRoute->delete();
            $currentRoute = new Router();
            $currentRoute->route = "blog/post/" . $blog->seourl;
            $currentRoute->destination = "blog-processor";
            $currentRoute->update();
        } else {
            system\Helper::arcAddMessage("danger", "Invalid SEO Url");
            return;
        }

        $blog->tags = $_POST["tags"];
        $blog->categoryid = $_POST["cat"];

        if ($blog->poster == 0) {
                $blog->poster = system\Helper::arcGetUser()->id;   
        }
        
        $blog->update();

        system\Helper::arcAddMessage("success", "Blog post saved");
        system\Helper::arcReturnJSON([]);
}
