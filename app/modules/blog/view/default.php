<div class="page-header">
    <h1>
    <?php
        $title = SystemSetting::getByKey("ARC_BLOG_TITLE");
        echo $title->value;
    ?>
    </h1>
</div>

<?php
$blogs = Blog::getLatest();
$charCount = SystemSetting::getByKey("ARC_BLOG_CHAR_LIMIT");
buildBlog($blogs, $charCount->value);