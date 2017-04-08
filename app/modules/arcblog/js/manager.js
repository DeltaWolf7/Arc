var catID;

function catBtn(id) {
    catID = id;
    arcAjaxRequest("arcblog/cat", {action: "getcategory", id: id}, success, null);
}

function success(data) {
    var jdata = arcGetJson(data);
    $("#cattitle").val(jdata.name);
    $("#catseourl").val(jdata.seourl);
    $("#categoryModal").modal('show');
}

function catDelete(id) {
    arcAjaxRequest("arcblog/deletecategory", {action: "deletecategory", id: id}, deleteSuccess, null);
}

function deleteSuccess(data) {
    var jdata = arcGetJson(data);
    get("categories");
    updateStatus("status");
}

$("#catSave").click(function () {
    $.ajax({
        url: "<?php system\Helper::arcGetDispatch(); ?>",
        dataType: "json",
        type: "post",
        contentType: "application/x-www-form-urlencoded",
        data: {action: "saveCategory", id: catID, name: $("#cattitle").val(), seourl: $("#catseourl").val()},
        complete: function (data) {
            $("#categoryModal").modal('hide');
            get("categories");
            updateStatus("status");
        }
    });
});

$("#clearCache").click(function () {
    $.ajax({
        url: "<?php system\Helper::arcGetDispatch(); ?>",
        dataType: "json",
        type: "post",
        contentType: "application/x-www-form-urlencoded",
        data: {action: "clearcache"},
        complete: function (data) {
            updateStatus("status");
        }
    });
});

var postid;
function editPost(id) {
    postid = id;
    $.ajax({
        url: "<?php system\Helper::arcGetDispatch(); ?>",
        dataType: "json",
        type: "post",
        contentType: "application/x-www-form-urlencoded",
        data: {action: "getpost", id: id},
        success: function (data) {
            var jdata = jQuery.parseJSON(JSON.stringify(data));
            $("#title").val(jdata.title);
            $("#tags").val(jdata.tags);
            $("#seourl").val(jdata.seourl);
            $('.summernote').code(jdata.content);
            $('#dateData').val(jdata.date);
            $('#selected').html(jdata.sel);
            $('#image').html(jdata.img);
            $("#postModal").modal('show');
        }
    });
}

$("#postSaveBtn").click(function () {
    $.ajax({
        url: "<?php system\Helper::arcGetDispatch(); ?>",
        dataType: "json",
        type: "post",
        contentType: "application/x-www-form-urlencoded",
        data: {action: "savePost", id: postid, title: $("#title").val(), tags: $("#tags").val(), seourl: $("#seourl").val(),
                            content: $(".summernote").code(), date: $("#dateDate").val(), posterid: <?php echo system\Helper::arcGetUser()->id; ?>},
complete: function (data) {
                                    $("#categoryModal").modal('hide');
                            get("categories");
                            updateStatus("status");
}
});
});

$("#posts").click(function () {
                            get("posts");
});

$("#categories").click(function () {
                            get("categories");
});

$("#addPostCat").click(function () {
                            if ($('#cat').val() != null) {
                                $.ajax({
                                    url: "<?php system\Helper::arcGetDispatch(); ?>",
                                    dataType: "json",
                                    type: "post",
                                    contentType: "application/x-www-form-urlencoded",
                                    data: {action: "addpostcat", id: postid, catname: $('#cat').val()},
complete: function (data) {
                                                        editPost(postid);
                                                get("posts");
                                                updateStatus("status");
}
});
}
});

$("#remPostCat").click(function () {
                                                if ($('#sel').val() != null) {
                                                    $.ajax({
                                                        url: "<?php system\Helper::arcGetDispatch(); ?>",
                                                        dataType: "json",
                                                        type: "post",
                                                        contentType: "application/x-www-form-urlencoded",
                                                        data: {
                                                                    action: "rempostcat", id: postid, catname: $('#sel').val()},
complete: function (data) {
                                                                            editPost(postid);
                                                                    get("posts");
                                                                    updateStatus("status");
}
});
}
});

function get(action) {
                                                                    if (action == "posts") {
                                                                                $("#posts").attr("class", "active");
                                                                                $("#categories").removeClass("active");
} else {
                                                                                        $("#posts").removeClass("active");
                                                                                $("#categories").attr("class", "active");
}
$.ajax({
                                                                                url: "<?php system\Helper::arcGetDispatch(); ?>",
                                                                                dataType: "json",
                                                                                type: "post",
                                                                                contentType: "application/x-www-form-urlencoded",
                                                                                data: {action: action},
success: function (data) {
                                                                                                    var jdata = jQuery.parseJSON(JSON.stringify(data));
                                                                                            $('#data').html(jdata.html);
}
});
}

$(document).ready(function () {
                                                                                            get("posts");
                                                                                            $('.summernote').summernote({height: 250,
                                                                                                toolbar: [
                                                                                                    ['style', ['bold', 'italic', 'underline', 'clear']],
                                                                                                    ['insert', ['superscript', 'subscript']],
                                                                                                    ['color', ['color']],
                                                                                                    ['para', ['ul', 'ol']],
                                                                                                    ['height', ['height']],
                                                                                                    ['table', ['table']],
                                                                                                    ['link', ['link', 'picture']],
                                                                                                    ['source', ['codeview']]
                                                                                                ],
                                                                                                onImageUpload: function (files, editor, welEditable) {
                                                                                                        sendFile(files[0], editor, welEditable);
}
});
function sendFile(file, editor, welEditable) {
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
                                                                                                                            editor.insertImage(welEditable, jdata.data);
} else {
                                                                                                                                    updateStatus("status");
}
$("body").removeClass();
$("body").addClass("modal-open");
}
});
}
$('#date').datetimepicker({
                                                                                                                            pickTime: true
});
});