<div class="page-header">
    <h1>Blog</h1>
</div>


<?php
$path = arcGetURLData("data1");

if (!empty($path)) {
    if ($path == "post") {
        $blog = Blog::getBySEOUrl(arcGetURLData("data2"));
        $content = $blog->content;
        if (!empty($blog->tags)) {
            $tags = $blog->tags;
        }
        include arcGetModulePath(true) . "/view/post.php";
    } elseif ($path == "category") {
        $category = BlogCategory::getBySEOUrl(arcGetURLData("data2"));
        $blogs = Blog::getAllByCategory($category->id);
        buildBlog($blogs);
    } elseif ($path == "poster") {
        $poster = new User();
        $poster->getByID(arcGetURLData("data2"));
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
        include arcGetModulePath(true) . "/view/post.php";
    }
}
?>