<div class="page-header">
    <h1>Blog Manager</h1>
</div>

<p class="text-right"><a class="btn btn-default btn-sm" id="clearCache"><i class="fa fa-trash-o"></i> Clear Cache</a></p>
<div role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#" aria-controls="posts" role="tab" data-toggle="tab" id="posts">Posts</a></li>
        <li role="presentation"><a href="#" aria-controls="categories" role="tab" data-toggle="tab" id="categories">Categories</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="data">
        </div>
    </div>
</div>

<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Edit Post</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" id="title" maxlength="100" />
                        </div>
                        <div class="form-group">
                            <label>SEO Url</label>
                            <input type="text" class="form-control" id="seourl" maxlength="100" />
                        </div>
                        <div class="form-group">
                            <label>Tags</label>
                            <input type="text" class="form-control" id="tags" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date</label>
                            <div class='input-group date' id='date'>
                                <input type='text' class="form-control" data-date-format="DD/MM/YYYY"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group" id="image">
                            <label>Image</label>
                            <img class="img-rounded" src="<?php echo system\Helper::arcGetPath() . "app/modules/blog/images/placeholder.png"; ?>" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="summernote"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categories</label>
                            <select class="form-control" id="cat" size="5">"
                                <?php
                                $categories = BlogCategory::getAllCategories();
                                foreach ($categories as $cat) {
                                    echo "<option value=\"" . $cat->id . "\">" . $cat->name . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-default"><i class="fa fa-edit"></i> Add To Category</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="selected">
                            <label>Selected Categories</label>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-default"><i class="fa fa-remove"></i> Remove From Category</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary">Save</a>
            </div>
        </div>
    </div>
</div>

<script>
    $("#clearCache").click(function () {
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
    });

    function editPost(id) {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getpost", id: id},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#title").val(jdata.title);
                $("#tags").val(jdata.tags);
                $("#seourl").val(jdata.seourl);
                $('.summernote').code(jdata.content);
                $('#date').val(jdata.date);
                $('#selected').html(jdata.sel);
                $("#postModal").modal('show');
            }
        });
    }

    $("#posts").click(function () {
        get("posts");
    });

    $("#categories").click(function () {
        get("categories");
    });

    function get(action) {
        if (action == "posts") {
            $("#posts").attr("class", "active");
            $("#categories").removeClass("active");
        } else {
            $("#posts").removeClass("active");
            $("#categories").attr("class", "active");
        }
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: action},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $('#data').html(jdata.html);
            }
        });
    }

    $(document).ready(function () {
        get("posts");
        $('.summernote').summernote({height: 250,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['link', ['link', 'picture', 'hr']],
                ['source', ['codeview']]
            ],
            onChange: function (contents, $editable) {
                $("body").removeClass();
                $("body").addClass("modal-open");
            }
        });
        $('#date').datetimepicker({
            pickTime: false
        });
    });
</script>