<?php

if (system\Helper::arcIsAjaxRequest()) {
    $data = "<table class=\"table table-striped\">";
        $data .= "<thead class=\"thead-default\"><tr><th>Title</th><th>Category</th><th>Date</th><th>SEO Url</th><th class=\"text-right\"><button class=\"btn btn-primary btn-sm\" onclick=\"editPost(0);\"><i class=\"fa fa-plus\"></i> New Post</button></th></tr></thead>";
        $data .= "<tbody>";
        $blogs = Blog::getAllBlogs();
        foreach ($blogs as $blog) {
            $data .= "<tr><td>{$blog->title}</td><td>";
            $category = $blog->getCategory();
            if ($category->id > 0) {
                $data .= "<i class=\"badge badge-success\">{$category->name}</i> ";
            } else {
                $data .= "<i class=\"badge badge-danger\">Category Missing</i> ";
            }
            $data .= "</td><td>" . system\Helper::arcConvertDateTime($blog->date) . "</td><td>{$blog->seourl}</td><td class=\"text-right\"><button class=\"btn btn-success btn-sm\" href=\"#\" onclick=\"editPost({$blog->id});\"><i class=\"fa fa-pencil\"></i> Edit</button> <button onclick=\"deletePost({$blog->id});\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-remove\"></i> Delete</button></td></tr>";
        }
        $data .= "</tbody></table>";
        system\Helper::arcReturnJSON(["html" => $data]);
}
