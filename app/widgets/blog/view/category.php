<div class="page-header">
    <h1>
        <?php
        if (!empty(system\Helper::arcGetURLData("data1"))) {
            $category = BlogCategory::getBySEOUrl(system\Helper::arcGetURLData("data1"));
            echo $category->name;
        }
        ?>
    </h1>
</div>

<div class="row">
    <div class="col-md-9">
        <?php
        $charCount = SystemSetting::getByKey("ARC_BLOG_CHAR_LIMIT");
        $page = 0;
        if (!empty(system\Helper::arcGetURLData("data2"))) {
            $page = system\Helper::arcGetURLData("data2");
        }
        $blogs = Blog::getAllByCategory($category->name);
        $entries = SystemSetting::getByKey("ARC_BLOG_ENTRIES_PER_PAGE");
        $selection = system\Helper::arcPagination($blogs, $page, $entries->value);
        buildBlog($selection, $charCount->value);
        $url = system\Helper::arcGetModulePath() . "category/" . system\Helper::arcGetURLData("data1");
        system\Helper::arcGetPaginationView($blogs, $page, $entries->value, true, $url);
        ?>
    </div>
    <?php require_once system\Helper::arcGetPath(true) . "app/modules/blog/includes/categories.php"; ?>
</div>
