<?php
if (arcGetURLData("data2") == "edit") {
    if (arcGetURLData("data3") == "post") {
        include arcGetModulePath(true) . "pages/post.php";
    } elseif (arcGetURLData("data3") == "category") {
        include arcGetModulePath(true) . "pages/category.php";
    }
} elseif (arcGetURLData("data2") == "delete") {
    if (arcGetURLData("data3") == "post") {
        $post = new Blog();
        $post->delete(arcGetURLData("data4"));
    } elseif (arcGetURLData("data3") == "category") {
        $cat = new BlogCategory();
        $cat->delete(arcGetURLData("data4"));
    }
    arcRedirect(arcGetModulePath());
} else {
    include arcGetModulePath(true) . "pages/default.php";
}
?>