<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if ($_POST["action"] == "clearcache") {
        $thumbs = scandir(system\Helper::arcGetPath(true) . "app/modules/blog/images/thumbs/");
        foreach ($thumbs as $thumb) {
            if ($thumb != "." && $thumb != "..") {
                unlink(system\Helper::arcGetPath(true) . "app/modules/blog/images/thumbs/{$thumb}");
            }
        }
        echo json_encode(["status" => "success", "data" => "Cache has been cleaned."]);
    } elseif ($_POST["action"] == "posts") {
        $data = "<table class=\"table table-striped\">";
        $data .= "<tr><th>Title</th><th>Category</th><th>Date</th><th class=\"text-right\"><a class=\"btn btn-primary btn-sm\" onclick=\"editPost(0);\"><i class=\"fa fa-plus\"></i> New Post</a></th></tr>";
        $blogs = Blog::getAllBlogs();
        foreach ($blogs as $blog) {
            $data .= "<tr><td>{$blog->title}</td><td>";
            $categories = $blog->getCategories();
            foreach ($categories as $category) {
                $data .= "<i class=\"label label-default\">{$category->name}</i> ";
            }
            $data .= "</td><td>{$blog->date}</td><td class=\"text-right\"><a class=\"btn btn-default btn-sm\" href=\"#\" onclick=\"editPost({$blog->id});\"><i class=\"fa fa-pencil\"></i> Edit</a> <a class=\"btn btn-default btn-sm\"><i class=\"fa fa-remove\"></i> Delete</a></td></tr>";
        }
        $data .= "</table>";
        echo utf8_encode(json_encode(["html" => $data]));
    } elseif ($_POST["action"] == "categories") {
        $data = "<table class=\"table table-striped\">";
        $data .= "<tr><th>Name</th><th class=\"text-right\"><a class=\"btn btn-primary btn-sm\"><i class=\"fa fa-plus\"></i> New Category</a></th></tr>";
        $cats = BlogCategory::getAllCategories();
        foreach ($cats as $cat) {
            $data .= "<tr><td><a href=\"#\">{$cat->name}</a></td><td class=\"text-right\"><a class=\"btn btn-default btn-sm\"><i class=\"fa fa-remove\"></i> Delete</a></td></tr>";
        }
        $data .= "</table>";
        echo utf8_encode(json_encode(["html" => $data]));
    } elseif ($_POST["action"] == "getpost") {
        $blog = new Blog();
        $blog->getByID($_POST["id"]);
        $content = html_entity_decode($blog->content);
        $groups = $blog->getCategories();
        $group = " <label>Selected Categories</label><select class=\"form-control\" id=\"sel\" size=\"5\">";
        foreach ($groups as $cat) {
            $group .= "<option value=\"{$cat->name}\">{$cat->name}</option>";
        }
        $group .= "</select>";
        echo utf8_encode(json_encode(["title" => $blog->title, "content" => $content, "tags" => $blog->tags, "seourl" => $blog->seourl, "date" => $blog->date, "sel" => $group]));
    } elseif (count($_FILES) > 0) {
        if (isset($_FILES['file']['name'])) {
            if (!$_FILES['file']['error']) {
                $name = md5(rand(100, 200));
                $ext = explode('.', $_FILES['file']['name']);
                $filename = $name . '.' . $ext[1];
                $destination = system\Helper::arcGetPath(true) . "images/" . $filename; //change this directory
                $location = $_FILES["file"]["tmp_name"];
                move_uploaded_file($location, $destination);
                echo json_encode(["data" => system\Helper::arcGetPath() . "images/" . $filename, "status" => "success"]);
            } else {
                echo json_encode(["status" => "danger", "data" => "Error occured while uploading image."]);
            }
        }
    } else {
        echo json_encode(["status" => "danger", "data" => "No files to upload"]);
    }
}