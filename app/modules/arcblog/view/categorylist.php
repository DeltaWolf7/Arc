<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Categories</h3>
    </div>
    <div class="panel-body">
        <ul class="list-unstyled">
            <?php $title = SystemSetting::getByKey("ARC_BLOG_TITLE"); ?>
            <?php
            $categories = BlogCategory::getAllCategories();
            if (count($categories) > 0) {
                foreach ($categories as $category) {
                    echo "<li class=\"list-item\">"
                    . "<a href=\"" . system\Helper::arcGetPath() . "blog/category/" . $category->seourl . "\">"
                    . "<i class=\"fa fa-folder\"></i> {$category->name}</a>"
                    . "</li>";
                }
            } else {
                echo "No categories";
            }
            ?>
        </ul>
    </div>
</div>
