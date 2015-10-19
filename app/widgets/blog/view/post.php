<?php
if (!empty(system\Helper::arcGetURLData("data1"))) {
    $blog = Blog::getBySEOUrl(system\Helper::arcGetURLData("data1"));
    ?>
    <div class="page-header">
        <h1>
            <?php
            echo $blog->title;
            ?>
        </h1>
    </div>
    <?php
    buildBlog($blog, 0);
} else {
    system\Helper::arcOverrideView("default");
}