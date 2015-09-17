<div class="page-header">
    <h1>The Wall</h1>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Say..
    </div>
    <div class="panel-body">
        <div class="summernote"></div>
    </div>
    <div class="panel-footer text-right">
        <a class="btn btn-default btn-sm" id="sendbtn"><i class="fa fa-send"></i> Post</a>
    </div>
</div>

<div id="status"></div>

<div id="data">
</div>

<script>
    $("#sendbtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "send", content: $('.summernote').code(), id: <?php echo system\Helper::arcGetUser()->id; ?>},
            complete: function (data) {
                updateStatus("status", updateStatusXCallback);
                getData();
            }
        });
    });

    function updateStatusXCallback(data) {
        $('.summernote').code("");
    }

    function getData() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getdata"},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#data").html(jdata.html);
            }
        });
    }

    $(document).ready(function () {
        $('.summernote').summernote({height: 150,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['insert', ['superscript', 'subscript']],
                ['link', ['picture']]
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
        
        getData();
    });
</script>