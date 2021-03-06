var page;

function editPage(pageid) {
    page = pageid;


    $('#summernote').summernote({
        height: 600,
        codemirror: { // codemirror options
            theme: 'monokai'
        },
        toolbar: [
            ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
            ['insert', ['superscript', 'subscript']],
            ['font', ['strikethrough']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['link', ['link', 'picture', 'video', 'hr']],
            ['misc', ['fullscreen']],
            ['source', ['undo', 'redo', 'codeview']]
        ],
        callbacks: {
            onImageUpload: function(files) {
                arcAjaxRequest("arc/pagemanagerupload", files[0], null, uploadComplete);
            }
        }
    });

    arcAjaxRequest("arc/pagemanageredit", { id: page }, null, successEdit);
}

function successEdit(data) {

    if ($('#summernote').summernote('codeview.isActivated')) {
        $('#summernote').summernote('codeview.deactivate');
    }

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
    animate(true);
}

function animate(showEditor) {
    if (showEditor === true) {
        $('#listDiv').fadeOut(300);
        $('#editorDiv').delay(400).fadeIn(300);
    } else {
        $('#editorDiv').fadeOut(300);
        $('#listDiv').delay(400).fadeIn(300);
    }
}

$("#savePageBtn").click(function() {
    arcAjaxRequest("arc/pagemanagersave", {
        id: page,
        title: $("#title").val(),
        seourl: $("#seourl").val(),
        metadescription: $("#metadescription").val(),
        metakeywords: $("#metakeywords").val(),
        html: $('#summernote').summernote('code'),
        iconclass: $("#iconclass").val(),
        sortorder: $("#sortorder").val(),
        showtitle: $('#showtitle').val(),
        hidelogin: $('#hidelogin').val(),
        hidemenu: $("#hidemenu").val(),
        theme: $('#theme').val()
    }, null, successSave);
});

$("#closeBtn").click(function() {
    animate(false);
});

function successSave(data) {
    var jdata = arcGetJson(data);
    if (jdata.status == "success") {
        animate(false);
        getPages();
    }
    arcGetStatus();
}

$("#insertModule").click(function() {
    $("#summernote").summernote("editor.insertText", "{{" + $("#imodule").val() + "}}");
});

function removePage(pageid) {
    page = pageid;
    $("#deletePage").modal("show");
}

$("#doRemoveBtn").click(function() {
    arcAjaxRequest("arc/pagemanagerremove", { id: page }, completeDo, null);
});

function completeDo(data) {
    getPages();
    $("#deletePage").modal("hide");
    arcGetStatus();
}

function getPages() {
    arcAjaxRequest("arc/pagemanagerget", {}, null, successGet);
}

function successGet(data) {
    var jdata = arcGetJson(data);
    $('#pages').html(jdata.html);
}

$(document).ready(function() {
    getPages();
});

function uploadComplete(data) {
    var jdata = arcGetJson(data);
    $('#summernote').summernote("insertImage", jdata.path);
}