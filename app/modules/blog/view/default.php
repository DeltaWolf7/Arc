<div class="page-header">
    <h1>Blog</h1>
</div>


<?php
$path = system\Helper::arcGetURLData("data1");

if (!empty($path)) {
    if ($path == "post") {
        $blog = Blog::getBySEOUrl(system\Helper::arcGetURLData("data2"));
        $content = $blog->content;
        if (!empty($blog->tags)) {
            $tags = $blog->tags;
        }
        include arcGetModulePath(true) . "/view/post.php";
    } elseif ($path == "category") {
        $category = BlogCategory::getBySEOUrl(system\Helper::arcGetURLData("data2"));
        $blogs = Blog::getAllByCategory($category->id);
        buildBlog($blogs);
    } elseif ($path == "poster") {
        $poster = new User();
        $poster->getByID(system\Helper::arcGetURLData("data2"));
        include arcGetModulePath(true) . "/view/poster.php";
    }
} else {
    $blogs = Blog::getLatest();
    buildBlog($blogs);
}

function buildBlog($blogs) {
    foreach ($blogs as $blog) {
        $charCount = 900;
        $content = $blog->content;
        if (strlen($blog->content) > $charCount) {
            $content = substr($blog->content, 0, $charCount - 1) . "..";
        }
        include system\Helper::arcGetModulePath(true) . "/view/post.php";
    }
}
?>