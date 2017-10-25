<?php

if (system\Helper::arcIsAjaxRequest()) {

    $html = "";

    $cat = ForumCategory::getByID($_POST["id"]);

    $html .= "<tr><td class=\"text-right\" colspan=\"3\">";

    if ($_POST["id"] != 0) {
        $html .= "<button class=\"btn btn-secondary\" onclick=\"getCategory({$cat->parentid})\">< Back</button> ";
    }

    if ($cat->allowpost == 1 && $_POST["id"] != 0) { 
        $html .= "<button class=\"btn btn-primary\" onclick=\"post({$cat->id})\">New Post</button> ";           
    }

    if (system\Helper::arcIsUserAdmin()) {
        $html .= "<button class=\"btn btn-primary\" onclick=\"newCategory({$cat->id})\">New Category</button> ";
        
        if ($_POST["id"] != 0) {

            $html .= "<button class=\"btn btn-danger\" onclick=\"deleteCat({$cat->id})\">Delete</button> ";

            if ($cat->allowpost == 1) {
                $html .= "<button class=\"btn btn-danger\" onclick=\"disallow({$cat->id})\">Disallow Posts</button> ";
            } else {
                $html .= "<button class=\"btn btn-success\" onclick=\"allow({$cat->id})\">Allow Posts</button> ";
            }
        }
    }

    $html .= "</td></tr>";

    

    $categories = ForumCategory::getCategories($_POST["id"]);
    foreach ($categories as $category) {
        $html .= "<tr><td>"
        . "<i class=\"fa fa-folder-o fa-2x\"></i>"
        . "</td><td>"
        . "<strong><a href=\"#\" onclick=\"getCategory({$category->id})\">{$category->name}</a></strong><br />"
        . "<small>{$category->description}</small>"
        . "</td><td class=\"text-right\">"
        . "<small>" . $category->getPostCount() . " Posts</small>"
        . "</td></tr>";
    }

    $posts = ForumPost::getPosts($_POST["id"]);
    foreach ($posts as $post) {
        if ($post->parentid == 0) {
            $html .= "<tr><td>"
            . "<i class=\"fa fa-file-o fa-2x text-primary\"></i>"
            . "</td><td>"
            . "<strong><a href=\"#\" onclick=\"getPost({$post->id})\">{$post->subject}</a></strong><br />";

            $user = User::getByID($post->posterid);

            $html .= "<small>Posted by " . $user->getFullname() . "</small>"
            . "</td><td class=\"text-right\">"
            . "<small>" . system\Helper::arcConvertDateTime($post->posted) . "</small>"
            . "</td></tr>";
        }
    }

    system\Helper::arcReturnJSON(["html" => $html]);
}
