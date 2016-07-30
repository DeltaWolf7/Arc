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
    arcAjaxRequest("arc/mediamanagerdelete", {items: data}, uploadComplete, null);
}

$(document).ready(function () {
    getManager();
});

function getManager() {
    arcAjaxRequest("arc/mediamanagerget", {path: path}, null, getComplete);
}

function getComplete(data) {
    var jdata = arcGetJson(data);
    $("#managerView").html(jdata.html);
    $('[data-toggle="popover"]').popover();
    marked = [];
}

$(document).on('change', '.btn-file :file', function () {
    arcAjaxRequest("arc/mediamanagerupload", $(this)[0].files[0], uploadComplete, null, {path: path});
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
    arcAjaxRequest("arc/mediamanagercreate", {path: path, name: $("#folderName").val()}, uploadComplete, null);
}

function getLink() {
    var data = JSON.stringify(marked);
    arcAjaxRequest("arc/mediamanagergetlink", {items: data}, null, getLinkComplete);
}

function getLinkComplete(data) {
    var jdata = arcGetJson(data);
    $("#linkText").val(jdata.links);
    $("#getLinkModal").modal('show');
}
