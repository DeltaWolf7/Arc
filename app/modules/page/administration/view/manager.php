<div class="page-header">
    <h1>Page Management</h1>
</div>

<div class="table-responsive">
    <table class="table table-hover table-condensed table-striped" id="pages">
    </table>
</div>
<div id="status"></div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Edit Page</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Page Details</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" placeholder="Title"
                                           maxlength="200" data-toggle="tooltip" data-placement="top" title="Page Title (200 characters max)">
                                </div>
                                <div class="form-group">
                                    <label for="seourl">SEO Url</label>
                                    <input type="text" class="form-control" id="seourl" placeholder="SEO Url" maxlength="50"
                                           data-toggle="tooltip" data-placement="top" title="SEO Url (50 characters max)">
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
                                    <textarea class="form-control" id="metadescription" maxlength="160" placeholder="META Description" 
                                              data-toggle="tooltip" data-placement="top" title="META Description (160 characters max)"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="metakeywords">META Keywords</label>
                                    <input type="text" class="form-control" id="metakeywords" maxlength="69" placeholder="META Keywords" 
                                           data-toggle="tooltip" data-placement="top" title="Meta Keywords (69 characters max)">
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="summernote"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="savePageBtn">Save</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deletePage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Delete Page</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to permanently delete this page?                    
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">No</a>
                <a class="btn btn-primary" id="doRemoveBtn">Yes</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

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

    $("#savePageBtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {id: page, action: "save", title: $("#title").val(), seourl: $("#seourl").val(),
                metadescription: $("#metadescription").val(), metakeywords: $("#metakeywords").val(),
                html: $('.summernote').code()},
            complete: function (data) {
                updateStatus("status", updateStatusCallback);
            }
        });

    });

    function updateStatusCallback(data) {
        if (data.danger == 0) {
            $("#myModal").modal('hide');
            getPages();
        } else {
            setTimeout(function () {
                $("#myModal").modal('show');
            }, 2000);
        }
    }

    function removePage(pageid) {
        page = pageid;
        $("#deletePage").modal("show");
    }

    $("#doRemoveBtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {id: page, action: "remove"},
            complete: function () {
                getPages();
                $("#deletePage").modal("hide");
                updateStatus("status", null);
            }
        });
    });

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
        $('.summernote').summernote({height: 250,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['insert', ['superscript', 'subscript']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['link', ['link', 'picture', 'hr']],
                ['source', ['codeview']]
            ],
            onImageUpload: function (files) {
                sendFile(files[0]);
            }
        });

        function sendFile(file) {
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
                        $('.summernote').summernote("insertImage", jdata.data);
                    } else {
                        updateStatus("status", null);
                    }
                    $("body").removeClass();
                    $("body").addClass("modal-open");
                }
            });
        }
        getPages();
    });
</script>