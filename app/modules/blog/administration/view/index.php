<?php
if (system\Helper::arcGetURLData("data2") == "edit") {
    if (system\Helper::arcGetURLData("data3") == "post") {
        include system\Helper::arcGetModulePath(true) . "view/post.php";
    } elseif (system\Helper::arcGetURLData("data3") == "category") {
        include system\Helper::arcGetModulePath(true) . "view/category.php";
    }
} elseif (system\Helper::arcGetURLData("data2") == "delete") {
    if (system\Helper::arcGetURLData("data3") == "post") {
        $post = new Blog();
        $post->delete(arcGetURLData("data4"));
    } elseif (system\Helper::arcGetURLData("data3") == "category") {
        $cat = new BlogCategory();
        $cat->delete(arcGetURLData("data4"));
    }
    system\Helper::arcRedirect(system\Helper::arcGetModulePath());
} else {
    include system\Helper::arcGetModulePath(true) . "view/default.php";
}