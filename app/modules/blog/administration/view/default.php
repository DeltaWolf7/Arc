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
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" id="title" />
                </div>
                <div class="form-group">
                            <div class="summernote"></div>
                        </div>
                <div class="form-group">
                    <label>Tags</label>
                    <input type="text" class="form-control" id="tags" />
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Cancel</a>
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
    
    function editPost(id){
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getpost"},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
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
        if (action == "users") {
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
        $('.summernote').summernote({height: 250});
    });
</script>