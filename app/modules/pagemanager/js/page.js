var page;

function editPage(pageid) {
    page = pageid;
    arcAjaxRequest("pagemanager/editpage", {id: page}, null, successEdit);
}

function successEdit(data) {
    var jdata = arcGetJson(data);
    $("#title").val(jdata.title);
    $("#seourl").val(jdata.seourl);
    $("#metadescription").val(jdata.metadescription);
    $("#metakeywords").val(jdata.metakeywords);
    $('#summernote').summernote('code', jdata.html);
    $("#iconclass").val(jdata.iconclass);
    $("#sortorder").val(jdata.sortorder);
    $("#showtitle").val(jdata.showtitle);
    $("#hidelogin").val(jdata.hidelogin);
    $("#hidemenu").val(jdata.hidemenu);
    $("#theme").val(jdata.theme);
    $("#myModal").modal('show');
}

$("#savePageBtn").click(function () {
    arcAjaxRequest("pagemanager/savepage", {id: page, title: $("#title").val(), seourl: $("#seourl").val(),
        metadescription: $("#metadescription").val(), metakeywords: $("#metakeywords").val(),
        html: $('#summernote').summernote('code'), iconclass: $("#iconclass").val(), sortorder: $("#sortorder").val(),
        showtitle: $('#showtitle').val(), hidelogin: $('#hidelogin').val(), hidemenu: $("#hidemenu").val(),
        theme: $('#theme').val()}, completeSave, null);
});

function completeSave(data) {
    arcGetStatus();
    $("#myModal").modal('hide');
    getPages();
}

$("#insertModule").click(function () {
    $(".summernote").summernote("editor.insertText", $("#imodule").val());
});

function removePage(pageid) {
    page = pageid;
    $("#deletePage").modal("show");
}

$("#doRemoveBtn").click(function () {
    arcAjaxRequest("pagemanager/removepage", {id: page}, completeDo, null);
});

function completeDo(data) {
    getPages();
    $("#deletePage").modal("hide");
    arcGetStatus();
}

function getPages() {
    arcAjaxRequest("pagemanager/getpages", {}, null, successGet);
}

function successGet(data) {
    var jdata = arcGetJson(data);
    $('#pages').html(jdata.html);
}

$(document).ready(function () {
    $('#summernote').summernote({
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
        callbacks: {
            onImageUpload: function (files) {
                // upload image to server and create imgNode...
                $summernote.summernote('insertNode', imgNode);
            }
        }
    });
    getPages();
});

function successSend(data) {
    var jdata = arcGetJson(data);
    if (jdata.status == "success") {
        $('.summernote').summernote("insertImage", jdata.data);
    } else {
        arcGetStatus();
    }
    $("body").removeClass();
    $("body").addClass("modal-open");
}