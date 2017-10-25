var cat;
var parentid;

$(document).ready(function () {
    // stops page caching
    cache: false;
    getCategory(0);
});

function getCategory(id) {
    arcAjaxRequest("arcforum/getCategory", {id: id}, null, updateDisplay);
}

function getPost(id) {
    arcAjaxRequest("arcforum/getPost", {id: id}, null, updateDisplay);
}

function updateDisplay(data) {
    var jdata = arcGetJson(data);
    $("#html").html(jdata.html);
}

$('#savePost').click(function(){

    if ($('#subject').val() == "") {
        alert("Please enter a subject.");
        return;
    }

    arcAjaxRequest("arcforum/post", {id: cat, subject: $('#subject').val(),
    post: arcCleanSummernote($('#summernote').summernote('code'))}, null, null);
    $('#postForm').hide();
    $('#posts').show();
    getCategory(0);
    $('#summernote').summernote('code', "");
});

function post(catid) {
    cat = catid;
    $('#postForm').show();
    $('#posts').hide();
    $('#summernote').summernote({
        height: 400,
        codemirror: { // codemirror options
            theme: 'monokai'
        },
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['insert', ['superscript', 'subscript']],
            ['font', ['strikethrough']],
            ['para', ['ul', 'ol']],
            ['link', ['link', 'picture', 'video']],
            ['source', ['undo', 'redo']]
        ],
        callbacks: {
            onImageUpload: function(files) {
                arcAjaxRequest("arcforum/imageupload", files[0], null, uploadComplete);
            }
        }
    });
}

function reply(parent, categoryid) {
    cat = categoryid;
    parentid = parent;
    $('#replyForm').show();
    $('#posts').hide();
    $('#rsummernote').summernote({
        height: 400,
        codemirror: { // codemirror options
            theme: 'monokai'
        },
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['insert', ['superscript', 'subscript']],
            ['font', ['strikethrough']],
            ['para', ['ul', 'ol']],
            ['link', ['link', 'picture', 'video']],
            ['source', ['undo', 'redo']]
        ],
        callbacks: {
            onImageUpload: function(files) {
                arcAjaxRequest("arcforum/imageupload", files[0], null, uploadComplete);
            }
        }
    });
}

$('#replyPost').click(function(){
    arcAjaxRequest("arcforum/reply", {id: cat, parent: parentid,
    post: arcCleanSummernote($('#rsummernote').summernote('code'))}, null, null);
    $('#replyForm').hide();
    $('#posts').show();
    $('#rsummernote').summernote('code', "");
    getPost(parentid);
});

function deletePost(postid) {
    arcAjaxRequest("arcforum/deletepost", {post: postid}, null, null);
    location.reload();
}

function allow(category) {
    arcAjaxRequest("arcforum/allow", {categoryid: category, allow: 1}, null, null);
    getCategory(category);
}

function disallow(category) {
    arcAjaxRequest("arcforum/allow", {categoryid: category, allow: 0}, null, null);
    getCategory(category);
}

function newCategory(parent) {
    parentid = parent
    $("#catForm").show();
    $('#posts').hide();
}

$('#saveCat').click(function() {
    arcAjaxRequest("arcforum/saveCat", {parentid: parentid,
         name: $("#category").val(), description: $("#description").val()}, null, null);
    getCategory(parentid);
});

function deleteCat(category) {
    arcAjaxRequest("arcforum/deleteCat", {category: category}, null, null);
    location.reload();
}