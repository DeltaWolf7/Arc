<?php

if (system\Helper::arcIsAjaxRequest()) {
        $category = BlogCategory::getByID($_POST["id"]);

        $blogs = Blog::getAllByCategoryID($_POST["id"]);
        if (count($blogs) > 0) {
                system\Helper::arcAddMessage("danger", "Unable to delete category with attached posts");
                system\Helper::arcReturnJSON(["error" => "Unable to delete category with attached posts"]);
                return;
        }

        $category->delete($_POST["id"]);

        $currentRoute = Router::getRoute("blog/category/" . $category->seourl);
        $currentRoute->delete($currentRoute->id);

        system\Helper::arcAddMessage("success", "Blog category deleted");
        system\Helper::arcReturnJSON([]);
}
