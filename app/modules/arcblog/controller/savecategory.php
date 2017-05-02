<?php

if (system\Helper::arcIsAjaxRequest()) {
     $category = new BlogCategory();
        $category->getByID($_POST["id"]);

        if (empty($_POST["name"])) {
            system\Helper::arcAddMessage("danger", "Blog category must have a name");
            return;
        }

        if (empty($_POST["seourl"])) {
            system\Helper::arcAddMessage("danger", "Blog category must have a SEO Url");
            return;
        }

        $seocheck = BlogCategory::getBySEOUrl($_POST["seourl"]);
        if ($seocheck->id != $category->id) {
            system\Helper::arcAddMessage("danger", "SEO Url already in use by " . $seocheck->name);
            return;
        }

        $category->name = $_POST["name"];
        if (preg_match('`^[a-zA-Z0-9_]{1,}$`', $_POST["seourl"])) {
            $category->seourl = strtolower($_POST["seourl"]);
        } else {
            system\Helper::arcAddMessage("danger", "Invalid SEO Url");
            return;
        }

        $category->update();

        system\Helper::arcAddMessage("success", "Blog category saved");
}