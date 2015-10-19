<div class="page-header">
    <h1>
        <?php
        $title = SystemSetting::getByKey("ARC_BLOG_TITLE");
        echo $title->value;
        ?>
    </h1>
</div>

<div class="row">
    <div class="col-md-9">
        <?php
        $latest = SystemSetting::getByKey("ARC_BLOG_NOLATEST");
        $blogs = Blog::getLatest($latest->value);
        $charCount = SystemSetting::getByKey("ARC_BLOG_CHAR_LIMIT");
        buildBlog($blogs, $charCount->value);
        ?>
    </div>
    <?php require_once system\Helper::arcGetPath(true) . "app/modules/blog/includes/categories.php"; ?>
</div>