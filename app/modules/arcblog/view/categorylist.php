<div class="card">
    <div class="card-body">
        <h3 class="card-title">Categories</h3>
        <ul class="list-unstyled">
            <?php 
            $title = SystemSetting::getByKey("ARC_BLOG_TITLE");
            $categories = BlogCategory::getAllCategories();
            if (count($categories) > 0) {
                foreach ($categories as $category) {
                    echo "<li class=\"list-item\">"
                    . "<a href=\"" . $category->getUrl() . "\">"
                    . "{$category->name}"
                    . "</a>"
                    . "</li>";
                }
            } else {
                echo "No categories";
            }
            ?>
        </ul>
    </div>
</div>
