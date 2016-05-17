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
}

$(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

    /*NOT WORKING WITH PATH*/
    arcAjaxRequest("mediamanager/uploadfile", input[0].files[0], null, uploadComplete);
        
    input.trigger('fileselect', [numFiles, label]);
});

function uploadComplete() {
    arcGetStatus();
    getManager();
}

function getPath(folderPath) {
    path = folderPath;
    getManager();
}

