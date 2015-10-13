var page;

function editPage(pageid) {
    page = pageid;
    arcAjaxRequest({id: pageid, action: "edit"}, null, successEdit);
}

function successEdit(data) {
    var jdata = jQuery.parseJSON(JSON.stringify(data));
    $("#title").val(jdata.title);
    $("#seourl").val(jdata.seourl);
    $("#metadescription").val(jdata.metadescription);
    $("#metakeywords").val(jdata.metakeywords);
    $('.summernote').code(jdata.html);
    $("#myModal").modal('show');
}

$("#savePageBtn").click(function () {
    arcAjaxRequest({id: page, action: "save", title: $("#title").val(), seourl: $("#seourl").val(),
        metadescription: $("#metadescription").val(), metakeywords: $("#metakeywords").val(),
        html: $('.summernote').code()}, completeSave, null);
});

function completeSave(data) {
    updateStatus("status", updateStatusCallback);
}

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
    arcAjaxRequest({id: page, action: "remove"}, completeDo, null);
});

function completeDo(data) {
    getPages();
    $("#deletePage").modal("hide");
    updateStatus("status", null);
}

function getPages() {
    arcAjaxRequest({action: "getpages"}, null, successGet);
}

function successGet(data) {
    var jdata = jQuery.parseJSON(JSON.stringify(data));
    $('#pages').html(jdata.html);
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
        arcAjaxRequest(data, null, successSend);
        //data: data,
        //    url: "<?php system\Helper::arcGetDispatch(); ?>",
        //    cache: false,
        //   type: "post",
        //    contentType: false,
        //   processData: false,
        //   dataType: "json",
    }
    getPages();
});

function successSend(data) {
    var jdata = jQuery.parseJSON(JSON.stringify(data));
    if (jdata.status == "success") {
        $('.summernote').summernote("insertImage", jdata.data);
    } else {
        updateStatus("status", null);
    }
    $("body").removeClass();
    $("body").addClass("modal-open");
}