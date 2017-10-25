var catID;
var postid;

function catBtn(id) {
    catID = id;
    arcAjaxRequest("arcblog/getcategory", { id: id }, null, success);
}

function success(data) {
    var jdata = arcGetJson(data);
    $("#cattitle").val(jdata.name);
    $("#catseourl").val(jdata.seourl);
    $("#categoryModal").modal('show');
}

function catDelete(id) {
    arcAjaxRequest("arcblog/deletecategory", { id: id }, deleteCatSuccess, null);
}

function deleteSuccess(data) {
    arcAjaxRequest("arcblog/getposts", {}, null, getCatComplete);
    arcGetStatus();
}

function deleteCatSuccess(data) {
    arcAjaxRequest("arcblog/getcategories", {}, null, getCatComplete);
    arcGetStatus();
}

$("#catSave").click(function() {
    arcAjaxRequest("arcblog/savecategory", {
        id: catID,
        name: $("#cattitle").val(),
        seourl: $("#catseourl").val()
    }, saveCatComplete, null);
});


function editPost(id) {
    postid = id;

    $('#summernote').summernote({
        height: 400,
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
                arcAjaxRequest("arcblog/imageupload", files[0], null, uploadComplete);
            }
        }
    });

    arcAjaxRequest("arcblog/editpost", { id: id }, null, editComplete);
}

function editComplete(data) {
    if ($('#summernote').summernote('codeview.isActivated')) {
        $('#summernote').summernote('codeview.deactivate');
    }

    var jdata = arcGetJson(data);
    $("#title").val(jdata.title);
    $("#tags").val(jdata.tags);
    $("#seourl").val(jdata.seourl);
    $('#summernote').summernote('code', jdata.content);
    $('#date').val(jdata.date);
    $('#cat').html(jdata.sel);
    $('#image').html(jdata.img);
    $("#postEditor").show();
    $("#tabs").hide();
}

$("#postSaveBtn").click(function() {
    arcAjaxRequest("arcblog/savepost", {
        id: postid,
        title: $("#title").val(),
        tags: $("#tags").val(),
        seourl: $("#seourl").val(),
        content: arcCleanSummernote($('#summernote').summernote('code')),
        date: $("#date").val(),
        cat: $("#cat").val()
    }, null, saveComplete);
});

function saveCatComplete() {
    $("#categoryModal").modal('hide');
    arcAjaxRequest("arcblog/getcategories", {}, null, getCatComplete);
    arcGetStatus();
}

function saveComplete(data) {
    var jdata = arcGetJson(data);
    if (jdata.error) {
        arcGetStatus();
        return;
    }
    $("#postEditor").hide();
    $("#tabs").show();
    arcAjaxRequest("arcblog/getposts", {}, null, getPostsComplete);
    arcGetStatus();
}

function catCompete() {
    arcAjaxRequest("arcblog/getcategories", {}, null, getCatComplete);
    arcGetStatus();
}

$("#tabPosts").click(function() {
    arcAjaxRequest("arcblog/getposts", {}, null, getPostsComplete);
});

$("#tabCategories").click(function() {
    arcAjaxRequest("arcblog/getcategories", {}, null, getCatComplete);
});

function getPostsComplete(data) {
    var jdata = arcGetJson(data);
    $('#posts').html(jdata.html);
}

function getCatComplete(data) {
    var jdata = arcGetJson(data);
    $('#categories').html(jdata.html);
}


$(document).ready(function() {

    arcAjaxRequest("arcblog/getposts", {}, null, getPostsComplete);

    $("#date").datetimepicker({
        format: 'dd-mm-yyyy hh:ii:ss',
        autoclose: true,
        todayBtn: true
    });
});

$("#cancelPost").click(function() {
    $("#postEditor").hide();
    $("#tabs").show();
});

function deletePost(id) {
    arcAjaxRequest("arcblog/deletepost", { id: id }, null, deleteComplete);
}

function deleteComplete() {
    arcAjaxRequest("arcblog/getposts", {}, null, getPostsComplete);
    arcGetStatus();
}

$("#removeImage").click(function() {
    arcAjaxRequest("arcblog/removeimage", { id: postid }, null, imageComplete);
});

function imageComplete(data) {
    var jdata = arcGetJson(data);
    $("#image").html(jdata.image);
    arcGetStatus();
}

$(document).on('change', '.btn-file :file', function() {
    if (postid == "0") {
        arcNotification({ messages: { message: "Please save the post before setting the image.", type: "danger" } });
        return;
    }
    arcAjaxRequest("arcblog/uploadimage", $(this)[0].files[0], null, imageComplete, { id: postid });
});