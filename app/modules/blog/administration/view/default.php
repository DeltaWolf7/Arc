<div class="page-header">
    <h1>Blog Manager</h1>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">Posts</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <tr><th>Title</th><th>Category</th><th class="text-right"><button class="btn btn-primary btn-xs" onclick="window.location = '<?php echo system\Helper::arcGetModulePath(); ?>edit/post/0'"><span class="fa fa-plus"></span> Create</button></th></tr>
                    <?php
                    $cats = BlogCategory::getAllCategories();
                    foreach ($cats as $cat) {
                        $posts = Blog::getAllByCategory($cat->id);
                        foreach ($posts as $post) {
                            ?>
                            <tr><td><?php echo $post->title; ?></td><td><span class="label label-default"> <?php echo $cat->name; ?></span></td><td class="text-right"><button class="btn btn-success btn-xs" onclick="window.location = '<?php echo system\Helper::arcGetModulePath(); ?>edit/post/<?php echo $post->id; ?>'"><span class="fa fa-plus"></span> Edit</button> <button class="btn btn-danger btn-xs" onclick="window.location = '<?php echo system\Helper::arcGetModulePath(); ?>delete/post/<?php echo $post->id; ?>'"><span class="fa fa-remove"></span> Delete</button></td></tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">Categories</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <tr><th>Name</th><th class="text-right"><button class="btn btn-primary btn-xs" onclick="window.location = '<?php echo system\Helper::arcGetModulePath(); ?>edit/category/0'"><span class="fa fa-plus"></span> Create</button></th></tr>
                    <?php
                    $cats = BlogCategory::getAllCategories();
                    foreach ($cats as $cat) {
                        ?>
                        <tr><td><?php echo $cat->name ?></td><td class="text-right"><button class="btn btn-success btn-xs" onclick="window.location = '<?php echo system\Helper::arcGetModulePath(); ?>edit/category/<?php echo $cat->id; ?>'"><span class="fa fa-plus"></span> Edit</button> <button class="btn btn-danger btn-xs" onclick="window.location = '<?php echo system\Helper::arcGetModulePath(); ?>delete/category/<?php echo $cat->id; ?>'"><span class="fa fa-remove"></span> Delete</button></td></tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>