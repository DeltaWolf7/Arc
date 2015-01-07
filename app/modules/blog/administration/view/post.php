<div class="page-header">
    <h1>Blog Manager</h1>
</div>

<?php
$page = new Blog();
if (system\Helper::arcGetURLData("data4") != "0") {
    $page->getByID(system\Helper::arcGetURLData("data4"));
}
?>


<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Post</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Title" maxlength="200" value="<?php echo $page->title; ?>">
                </div>
                <div class="form-group">
                    <label for="seourl">SEO Url</label>
                    <input type="text" class="form-control" id="seourl" placeholder="SEO Url" maxlength="50" value="<?php echo $page->seourl; ?>">
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input type="text" class="form-control" id="tags" placeholder="Post Tags" value="<?php echo $page->tags; ?>">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category">
                        <?php
                        $categories = BlogCategory::getAllCategories();
                        foreach ($categories as $category) {
                            echo "<option value=\"" . $category->id . "\"";
                            if ($category->id == $page->categoryid) {
                                echo " selected";
                            }
                            echo ">" . $category->name . "</option>";
                        }
                        ?>
                    </select>
                </div> 
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Image</h3>
            </div>
            <div class="panel-body">
                <div class="form-group text-center">
                    <?php
                    echo "<img id=\"img\" style=\"cursor: pointer;\" onclick=\"$('#imageModal').modal('show');\" ";
                    if (empty($page->image)) {
                        echo "src=\"" . system\Helper::arcGetPath() . "modules/blog/images/placeholder.png\"";
                    } else {
                        echo "src=\"" . system\Helper::arcGetPath() . "images/blog/" . $page->image . "\"";
                    }
                    echo " alt=\"Post Image\" class=\"img-rounded\" />";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-group">
            <div class="summernote"><?php echo html_entity_decode($page->content); ?></div>
        </div>
    </div>
</div>

<div class="text-right">

    <a class="btn btn-success" id="doUpdateBtn"><i class="fa fa-save"></i> Save</a></div>


<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only"><i class="fa fa-close"></i> Close</i></button>
                <h4 class="modal-title">Image Browser</h4>
            </div>
            <div class="modal-body">
                <?php
                if (!file_exists(system\Helper::arcGetPath(true) . "images/blog")) {
                    mkdir(system\Helper::arcGetPath() . "images/blog");
                }
                ?>
                <img onclick="selectImage('');" style="cursor: pointer;" src="<?php echo system\Helper::arcGetPath(); ?>modules/blog/images/placeholder.png" class="img-rounded"/> 
                <?php
                $files = scandir(system\Helper::arcGetPath(true) . "images/blog");
                foreach ($files as $file) {
                    if ($file != "." && $file != "..") {
                        ?>
                        <img onclick="selectImage('<?php echo $file; ?>');" style="cursor: pointer;" src="<?php echo system\Helper::arcGetPath(); ?>images/blog/<?php echo $file; ?>" height="150px" width="150px" class="img-rounded"/> 
                        <?php
                    }
                }
                ?>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>

<script>
    function selectImage(image) {
        ajax.send('POST', {action: 'setimage', id: '<?php echo $page->id; ?>', image: image}, '<?php echo system\Helper::arcGetDispatch(); ?>', null, true);
        var img = document.getElementById('img');
        if (image == '') {
            img.src = '<?php echo system\Helper::arcGetPath(); ?>/modules/blog/images/placeholder.png';
        } else {
            img.src = '<?php echo system\Helper::arcGetPath(); ?>/images/blog/' + image;
        }
        $('#imageModal').modal('hide');
    }

    $("'doUpdateBtn").click(function () {
        var txt = $('.summernote').code();
        ajax.send('POST', {action: 'savepost', categoryid: '#category', tags: '#tags', editor: txt, seourl: '#seourl', title: '#title', id: '<?php echo $page->id; ?>', poster: '<?php echo arcGetUser()->id; ?>'}, '<?php arcGetDispatch(); ?>', updateStatus, true);
    });

    $(document).ready(function () {
        $('.summernote').summernote();
    });

</script>