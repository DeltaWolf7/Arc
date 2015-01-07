<?php

if (isset($_POST["action"])) {
    if ($_POST["action"] == "clearcache") {
        $thumbs = scandir(system\Helper::arcGetPath(true) . "app/modules/blog/images/thumbs/");
        foreach ($thumbs as $thumb) {
            if ($thumb != "." && $thumb != "..") {
                unlink(system\Helper::arcGetPath(true) . "app/modules/blog/images/thumbs/" . $thumb);
            }
        }
        echo json_encode(["status" => "success", "data" => "Cache has been cleaned."]);
    } elseif ($_POST["action"] == "posts") {
        $data = "<table class=\"table table-striped\">";
        $data .= "<tr><th>Title</th><th>Category</th><th class=\"text-right\"><a class=\"btn btn-primary btn-sm\" onclick=\"editPost(0);\"><i class=\"fa fa-plus\"></i> New Post</a></th></tr>";
        $cats = BlogCategory::getAllCategories();
        foreach ($cats as $cat) {
            $posts = Blog::getAllByCategory($cat->id);
            foreach ($posts as $post) {
                $data .= "<tr><td>" . $post->title . "</td><td><i class=\"label label-default\">" . $cat->name . "</i></td><td class=\"text-right\"><a class=\"btn btn-default btn-sm\" onclick=\"editPost(" . $post->id . ");\"><i class=\"fa fa-plus\"></i> Edit</a> <a class=\"btn btn-default btn-sm\"><i class=\"fa fa-remove\"></i> Delete</a></td></tr>";
            }
        }
        $data .= "</table>";
        echo json_encode(["html" => $data]);
    } elseif ($_POST["action"] == "categories") {
        $data = "<table class=\"table table-striped\">";
        $data .= "<tr><th>Name</th><th class=\"text-right\"><a class=\"btn btn-primary btn-sm\"><i class=\"fa fa-plus\"></i> New Category</a></th></tr>";
        $cats = BlogCategory::getAllCategories();
        foreach ($cats as $cat) {
            $data .= "<tr><td>" . $cat->name . "</td><td class=\"text-right\"><a class=\"btn btn-default btn-sm\"><i class=\"fa fa-plus\"></i> Edit</a> <a class=\"btn btn-default btn-sm\"><i class=\"fa fa-remove\"></i> Delete</a></td></tr>";
        }

        $data .= "</table>";
        echo json_encode(["html" => $data]);
    } elseif ($_POST["action"] == "getpost") {
        echo json_encode(["html" => ""]);
    }
}