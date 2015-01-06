<div class="page-header">
    <h1>Blog Manager</h1>
</div>

<div class="text-right"><a class="btn btn-default btn-sm" onclick="clearCache()"><span class="fa fa-trash-o"></span> Clear Cache</a></div>

<div class="row">
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">Posts</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <tr><th>Title</th><th>Category</th><th class="text-right"><button class="btn btn-primary btn-sm" onclick=""><span class="fa fa-plus"></span> New Post</button></th></tr>
                    <?php
                    $cats = BlogCategory::getAllCategories();
                    foreach ($cats as $cat) {
                        $posts = Blog::getAllByCategory($cat->id);
                        foreach ($posts as $post) {
                            ?>
                            <tr><td><?php echo $post->title; ?></td><td><span class="label label-default"> <?php echo $cat->name; ?></span></td><td class="text-right"><button class="btn btn-default btn-sm" onclick=""><span class="fa fa-plus"></span> Edit</button> <button class="btn btn-default btn-sm" onclick=""><span class="fa fa-remove"></span> Delete</button></td></tr>
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
                    <tr><th>Name</th><th class="text-right"><button class="btn btn-primary btn-sm" onclick=""><span class="fa fa-plus"></span> New Category</button></th></tr>
                    <?php
                    $cats = BlogCategory::getAllCategories();
                    foreach ($cats as $cat) {
                        ?>
                        <tr><td><?php echo $cat->name ?></td><td class="text-right"><button class="btn btn-default btn-sm" onclick=""><span class="fa fa-plus"></span> Edit</button> <button class="btn btn-default btn-sm" onclick=""><span class="fa fa-remove"></span> Delete</button></td></tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function clearCache() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "clearcache"},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
            }
        });
    }
</script>