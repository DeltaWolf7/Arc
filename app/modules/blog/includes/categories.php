<div class="col-md-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Categories</h3>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                <?php $title = SystemSetting::getByKey("ARC_BLOG_TITLE"); ?>
                <li class="list-item"><a href="<?php echo system\Helper::arcGetModulePath(); ?>"><i class="fa fa-folder"></i> <?php echo $title->value; ?></a></li>
                    <?php
                    $categories = BlogCategory::getAllCategories();
                    foreach ($categories as $category) {
                        echo "<li class=\"list-item\">"
                        . "<a href=\"" . system\Helper::arcGetModulePath() . "category/" . $category->seourl . "\">"
                        . "<i class=\"fa fa-folder\"></i> " . $category->name . "</a>"
                        . "</li>";
                    }
                    ?>
            </ul>
        </div>
    </div>
</div>