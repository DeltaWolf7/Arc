<div class="page-header">
    <h1>Blog Manager</h1>
</div>


<div class="row">
    <div class="col-md-7">

        <div class="panel panel-default">
            <div class="panel-heading">Posts</div>
            <div class="panel-body">
                <ul class="list-group">
                    <?php
                    $cats = BlogCategory::getAllCategories();
                    foreach ($cats as $cat) {
                        $posts = Blog::getAllByCategory($cat->id);
                        foreach ($posts as $post) {
                            echo "<li class=\"list-group-item\"><a href=\"\">" . $post->title . "</a> <span class=\"label label-default\">" . $cat->name . "</span></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>
    <div class="col-md-5">

        <div class="panel panel-default">
            <div class="panel-heading">Categories</div>
            <div class="panel-body">
                <ul class="list-group">
                    <?php
                    $cats = BlogCategory::getAllCategories();
                    foreach ($cats as $cat) {
                        echo "<li class=\"list-group-item\"><a href=\"\">" . $cat->name . "</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>
</div>