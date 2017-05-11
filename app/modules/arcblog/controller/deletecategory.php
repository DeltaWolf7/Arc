<?php

if (system\Helper::arcIsAjaxRequest()) {
        $category = BlogCategory::getByID($_POST["id"]);
        $category->delete($_POST["id"]);

        $currentRoute = Router::getRoute("blog/category/" . $category->seourl);
        $currentRoute->delete($currentRoute->id);

        system\Helper::arcAddMessage("success", "Blog category deleted");
        system\Helper::arcReturnJSON([]);
}