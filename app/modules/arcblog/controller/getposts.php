<?php

if (system\Helper::arcIsAjaxRequest()) {
    $data = "<table class=\"table table-hover table-striped\">";
        $data .= "<thead><tr><th>Title</th><th>Category</th><th>Date</th><th class=\"text-right\"><button class=\"btn btn-primary btn-xs\" onclick=\"editPost(0);\"><i class=\"fa fa-plus\"></i> New Post</button></th></tr></thead>";
        $data .= "<tbody>";
        $blogs = Blog::getAllBlogs();
        foreach ($blogs as $blog) {
            $data .= "<tr><td>{$blog->title}</td><td>";
            $categories = $blog->getCategories();
            foreach ($categories as $category) {
                $data .= "<i class=\"label label-default\">{$category->name}</i> ";
            }
            $data .= "</td><td>{$blog->date}</td><td class=\"text-right\"><button class=\"btn btn-default btn-xs\" href=\"#\" onclick=\"editPost({$blog->id});\"><i class=\"fa fa-pencil\"></i> Edit</button> <button class=\"btn btn-default btn-xs\"><i class=\"fa fa-remove\"></i> Delete</button></td></tr>";
        }
        $data .= "</tbody></table>";
        system\Helper::arcReturnJSON(["html" => $data]);
}
