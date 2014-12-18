<div class="page-header">
    <h1>Page Management</h1>
</div>

<table class="table table-striped" id="pages">
</table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Page</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Page Details</h3>
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

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">META Details</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="metadescription">META Description</label>
                                        <input type="text" class="form-control" id="metadescription" maxlength="160" placeholder="META Description" value="<?php echo $page->metadescription; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="metakeywords">META Keywords</label>
                                        <input type="text" class="form-control" id="metakeywords" maxlength="69" placeholder="META Keywords" value="<?php echo $page->metakeywords; ?>">
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="summernote"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="savePage();">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deletePage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Page</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to permanently delete this page?                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" onclick="doRemove();">Yes</button>
            </div>
        </div>
    </div>
</div>

<script>
    var page;

    function editPage(pageid) {
        page = pageid;
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {id: pageid, action: "edit"},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#title").val(jdata.title);
                $("#seourl").val(jdata.seourl);
                $("#metadescription").val(jdata.metadescription);
                $("#metakeywords").val(jdata.metakeywords);
                $('.summernote').code(jdata.html);
                $("#myModal").modal('show');
            }
        });
    }

    function savePage() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {id: page, action: "save", title: $("#title").val(), seourl: $("#seourl").val(),
                metadescription: $("#metadescription").val(), metakeywords: $("#metakeywords").val(),
                html: $('.summernote').code()},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#myModal").modal('hide');
                updateStatus(jdata.status, jdata.data);
                if (jdata.status == "success") {
                    getPages();
                } else {
                    setTimeout(function () {
                        $("#myModal").modal('show');
                    }, 2000);
                }
            }
        });
    }

    function removePage(pageid) {
        page = pageid;
        $("#deletePage").modal("show");
    }

    function doRemove() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {id: page, action: "remove"},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
            },
            complete: function () {
                getPages();
                $("#deletePage").modal("hide");
            }
        });
    }

    function getPages() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getpages"},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $('#pages').html(jdata.html);
            }
        });
    }

    $(document).ready(function () {
        $('.summernote').summernote({height: 250});
        getPages();
    });
</script>
