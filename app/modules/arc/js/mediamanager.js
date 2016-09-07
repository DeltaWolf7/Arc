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

function copyToClipboard(data) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(data).select();
    document.execCommand("copy");
    $temp.remove();
    var message = {messages: {type: "primary", message: "Link copied to clipboard\n\r" + data}};
    arcNotification(message);
}

function viewFile(file, type, size, date) {
    $("#fileViewerModal").modal("show");
    var data = type.split("/");
    var header = "<div class=\"panel panel-default\"><div class=\"panel-body\">"
            + "Path: <a href=\"" + file + "\">" + file + "</a><br />"
            + "Type: " + type + "<br />"
            + "Size: " + size + "<br />"
            + "Date/Time: " + date + "<br />"
            + "Download: <a href=\"" + file + "\"><i class=\"fa fa-download\"></i></a>"
            + "</div></div>";
    var content = "";
    switch (data[0]) {
        case "image":
            content = "<img class='img-responsive' src='" + file + "' />";
            break;
        case "text":
            jQuery.get(file, function (txt) {
                content = "<textarea class='form-control' rows='20'>" + txt + "</textarea>";
            });
            break;
        case "video":
            content = "<video controls>"
                    + "<source src='" + file + "' type='" + type + "'>"
                    + "Your browser does not support the video tag."
                    + "</video>";
            break;
        case "audio":
            content = "<audio controls>"
                    + "<source src='" + file + "' type='" + type + "'>"
                    + "Your browser does not support the audio tag."
                    + "</audio>";
            break;
        default:
            content = "<div class=\"alert alert-info\">Unable to display this file type</div>"
            break;
    }
    $("#contentViewer").html(content + header);
}
