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
                arcAjaxRequest("arc/emailmanagerupload", files[0], null, uploadComplete);
            }
        }
    });

    arcAjaxRequest("arc/emailmanageredit", { id: page }, null, successEdit);
}

function successEdit(data) {

    if ($('#summernote').summernote('codeview.isActivated')) {
        $('#summernote').summernote('codeview.deactivate');
    }

    var jdata = arcGetJson(data);
    $("#subject").val(jdata.subject);
    $("#key").val(jdata.key);
    $('#summernote').summernote('code', jdata.text);
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
    arcAjaxRequest("arc/emailmanagersave", {
        id: page,
        subject: $("#subject").val(),
        key: $("#key").val(),
        html: $('#summernote').summernote('code'),
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
    arcAjaxRequest("arc/emailmanagerremove", { id: page }, completeDo, null);
});

function completeDo(data) {
    getPages();
    $("#deletePage").modal("hide");
    arcGetStatus();
}

function getPages() {
    arcAjaxRequest("arc/emailmanagerget", {}, null, successGet);
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

function send(emailid) {
    arcAjaxRequest("arc/emailmanagersend", { emailid: emailid }, arcGetStatus, null);
}