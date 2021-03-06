<?php

if (system\Helper::arcIsAjaxRequest()) {
     $category = BlogCategory::getByID($_POST["id"]);

        if (empty($_POST["name"])) {
            system\Helper::arcAddMessage("danger", "Blog category must have a name");
            system\Helper::arcReturnJSON(["error" => "Blog category must have a name"]);
            return;
        }

        if (empty($_POST["seourl"])) {
            system\Helper::arcAddMessage("danger", "Blog category must have a SEO Url");
            system\Helper::arcReturnJSON(["error" => "Blog category must have a SEO Url"]);
            return;
        }

        $seocheck = BlogCategory::getBySEOUrl($_POST["seourl"]);
        if ($seocheck->id != 0 && $seocheck->id != $category->id) {
            system\Helper::arcAddMessage("danger", "SEO Url already in use by " . $seocheck->name);
            return;
        }

        $currentRoute = Router::getRoute("blog/category/" . $category->seourl);

        // check  if the name has changed.

        $category->name = $_POST["name"];
        
        if (Router::isValid($_POST["seourl"])) {
            $category->seourl = strtolower($_POST["seourl"]);
            $currentRoute->delete();
            $currentRoute = new Router();
            $currentRoute->route = "blog/category/" . $category->seourl;
            $currentRoute->destination = "blog-processor";
            $currentRoute->update();
        } else {
            system\Helper::arcAddMessage("danger", "Invalid SEO Url");
            return;
        }

        $category->update();

        system\Helper::arcAddMessage("success", "Blog category saved");
        system\Helper::arcReturnJSON(["success" => "Blog category saved"]);
}