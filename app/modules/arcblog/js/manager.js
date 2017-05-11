var catID;
var postid;

function catBtn(id) {
    catID = id;
    arcAjaxRequest("arcblog/getcategory", { id: id }, null , success);
}

function success(data) {
    var jdata = arcGetJson(data);
    $("#cattitle").val(jdata.name);
    $("#catseourl").val(jdata.seourl);
    $("#categoryModal").modal('show');
}

function catDelete(id) {
    arcAjaxRequest("arcblog/deletecategory", { id: id }, deleteSuccess, null);
}

function deleteSuccess(data) {
    getCategories();
    arcGetStatus();
}

$("#catSave").click(function () {
    arcAjaxRequest("arcblog/savecategory", { id: catID, name: $("#cattitle").val(),
     seourl: $("#catseourl").val() }, saveComplete, null);
});


function editPost(id) {
    postid = id;
    arcAjaxRequest("arcblog/editpost", { id: id }, null, editComplete);
}

function editComplete(data) {
    var jdata = arcGetJson(data);
            $("#title").val(jdata.title);
            $("#tags").val(jdata.tags);
            $("#seourl").val(jdata.seourl);
            $('#summernote').summernote('code', jdata.content);
            $('#dateData').val(jdata.date);
            $('#selected').html(jdata.sel);
            $('#image').html(jdata.img);
            $("#postEditor").show();
            $("#tabs").hide();
}

$("#postSaveBtn").click(function () {
     arcAjaxRequest("arcblog/savepost", {
            id: postid, title: $("#title").val(), tags: $("#tags").val(), seourl: $("#seourl").val(),
            content: $("#summernote").code(), date: $("#dateDate").val(), posterid: "posterid"
        }, saveComplete, null);
});

function saveComplete() {
    var jdata = arcGetJson(data);
    if (jdata.error) {
        return;
    }
    $("#categoryModal").modal('hide');
    getCategories();
    arcGetStatus();
}



$("#addPostCat").click(function () {
   arcAjaxRequest("arcblog/addpostcategory", {id: postid, catname: $('#cat').val()}, catCompete, null);
});

$("#remPostCat").click(function () {
    arcAjaxRequest("arcblog/removepostcategory", {id: postid, catname: $('#sel').val()}, catCompete, null);
});

function catCompete() {
    getPosts();
    arcGetStatus();
}

$("#posts").click(function () {
    getPosts();
});

$("#categories").click(function () {
    getCategories();
});

function getCategories() {
    $("#posts").removeClass("active");
    $("#categories").attr("class", "active");
    arcAjaxRequest("arcblog/getcategories", {}, null, getComplete);
}

function getPosts() {
    $("#posts").attr("class", "active");
    $("#categories").removeClass("active");
    arcAjaxRequest("arcblog/getposts", {}, null, getComplete);
}

function getComplete(data) {
    var jdata = arcGetJson(data);
    $('#data').html(jdata.html);
}


$(document).ready(function () {
    $('#summernote').summernote({
        height: 300,
        codemirror: {// codemirror options
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
            onImageUpload: function (files) {
                arcAjaxRequest("arc/imageupload", files[0], null, uploadComplete);
            }
        }
    });

    getPosts();
});

$("#cancelPost").click(function() {
    $("#postEditor").hide();
            $("#tabs").show();
});