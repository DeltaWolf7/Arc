var path = "";
var marked = [];

function mark(item) {
    if ($.inArray(item, marked) !== -1) {
        marked = jQuery.grep(marked, function (value) {
            return value != item;
        });
    } else {
        marked.push(item);
    }
}

function doDelete() {
    var data = JSON.stringify(marked);
    arcAjaxRequest("mediamanager/dodelete", {items: data}, uploadComplete, null);
}

$(document).ready(function () {
    getManager();
});

function getManager() {
    arcAjaxRequest("mediamanager/getmanager", {path: path}, null, getComplete);
}

function getComplete(data) {
    var jdata = arcGetJson(data);
    $("#managerView").html(jdata.html);
    $('[data-toggle="popover"]').popover();
    marked = [];
}

$(document).on('change', '.btn-file :file', function () {
    arcAjaxRequest("mediamanager/uploadfile", $(this)[0].files[0], uploadComplete, null, {path: path});
});

function uploadComplete() {
    arcGetStatus();
    getManager();
}

function getFolderPath(folderPath) {
    path = folderPath;
    getManager();
}

function createFolder() {
    arcAjaxRequest("mediamanager/createfolder", {path: path, name: $("#folderName").val()}, uploadComplete, null);
}
