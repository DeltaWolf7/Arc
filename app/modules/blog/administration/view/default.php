<div class="page-header">
    <h1>Blog Manager</h1>
</div>

<p class="text-right"><a class="btn btn-default btn-xs" id="clearCache"><i class="fa fa-trash-o"></i> Clear Cache</a></p>
<div role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#" aria-controls="posts" role="tab" data-toggle="tab" id="posts">Posts</a></li>
        <li role="presentation"><a href="#" aria-controls="categories" role="tab" data-toggle="tab" id="categories">Categories</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active table-responsive" id="data">
        </div>
    </div>
</div>

<div id="status"></div>

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
                                <input id='dateData' type='text' class="form-control" data-date-format="DD/MM/YYYY"/>
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group" id="image">
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
                                    echo "<option value=\"" . $cat->name . "\">" . $cat->name . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-default" id="addPostCat"><i class="fa fa-edit"></i> Add To Category</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="selected">
                            <label>Selected Categories</label>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-default" id="remPostCat"><i class="fa fa-remove"></i> Remove From Category</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="postSaveBtn">Save</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="cattitle" maxlength="100" />
                        </div>
                        <div class="form-group">
                            <label>SEO Url</label>
                            <input type="text" class="form-control" id="catseourl" maxlength="100" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="catSave">Save</a>
            </div>
        </div>
    </div>
</div>

<script>
    var catID;

    function catBtn(id) {
        catID = id;
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getcategory", id: id},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#cattitle").val(jdata.name);
                $("#catseourl").val(jdata.seourl);
                $("#categoryModal").modal('show');
            }
        });
    }

    function catDelete(id) {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "deletecategory", id: id},
            complete: function (data) {
                get("categories");
                updateStatus("status");
            }
        });
    }

    $("#catSave").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "saveCategory", id: catID, name: $("#cattitle").val(), seourl: $("#catseourl").val()},
            complete: function (data) {
                $("#categoryModal").modal('hide');
                get("categories");
                updateStatus("status");
            }
        });
    });

    $("#clearCache").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "clearcache"},
            complete: function (data) {
                updateStatus("status");
            }
        });
    });

    var postid;
    function editPost(id) {
        postid = id;
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
                $('#dateData').val(jdata.date);
                $('#selected').html(jdata.sel);
                $('#image').html(jdata.img);
                $("#postModal").modal('show');
            }
        });
    }
    
    $("#postSaveBtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "savePost", id: postid, title: $("#title").val(), tags: $("#tags").val(), seourl: $("#seourl").val(),
                        content: $(".summernote").code(), date: $("#dateDate").val(), posterid: <?php echo system\Helper::arcGetUser()->id; ?>},
            complete: function (data) {
                $("#categoryModal").modal('hide');
                get("categories");
                updateStatus("status");
            }
        });
    });

    $("#posts").click(function () {
        get("posts");
    });

    $("#categories").click(function () {
        get("categories");
    });

    $("#addPostCat").click(function () {
        if ($('#cat').val() != null) {
            $.ajax({
                url: "<?php system\Helper::arcGetDispatch(); ?>",
                dataType: "json",
                type: "post",
                contentType: "application/x-www-form-urlencoded",
                data: {action: "addpostcat", id: postid, catname: $('#cat').val()},
                complete: function (data) {
                    editPost(postid);
                    get("posts");
                    updateStatus("status");
                }
            });
        }
    });

    $("#remPostCat").click(function () {
        if ($('#sel').val() != null) {
            $.ajax({
                url: "<?php system\Helper::arcGetDispatch(); ?>",
                dataType: "json",
                type: "post",
                contentType: "application/x-www-form-urlencoded",
                data: {action: "rempostcat", id: postid, catname: $('#sel').val()},
                complete: function (data) {
                    editPost(postid);
                    get("posts");
                    updateStatus("status");
                }
            });
        }
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
                ['insert', ['superscript', 'subscript']],
                ['color', ['color']],
                ['para', ['ul', 'ol']],
                ['height', ['height']],
                ['table', ['table']],
                ['link', ['link', 'picture']],
                ['source', ['codeview']]
            ],
            onImageUpload: function (files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
            }
        });
        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                url: "<?php system\Helper::arcGetDispatch(); ?>",
                cache: false,
                type: "post",
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    var jdata = jQuery.parseJSON(JSON.stringify(data));
                    if (jdata.status == "success") {
                        editor.insertImage(welEditable, jdata.data);
                    } else {
                        updateStatus("status");
                    }
                    $("body").removeClass();
                    $("body").addClass("modal-open");
                }
            });
        }
        $('#date').datetimepicker({
            pickTime: true
        });
    });
</script>