var path = "assets/";

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
}

$(document).on('change', '.btn-file :file', function () {
    arcAjaxRequest("mediamanager/uploadfile", $(this)[0].files[0], uploadComplete, null, {path: path});
});

function uploadComplete() {
    arcGetStatus();
    getManager();
}

function getPath(folderPath) {
    path = folderPath;
    getManager();
}

function createFolder() {
    arcAjaxRequest("mediamanager/createfolder", {path: path, name: $("#folderName").val()}, uploadComplete, null);
}
