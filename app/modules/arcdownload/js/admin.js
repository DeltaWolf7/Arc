$(document).ready(function() {
    getDownloads();
});

function getDownloads() {
    arcAjaxRequest("arcdownload/getDownloads", {}, null, getDownloadsComplete);
}

function getDownloadsComplete(data) {
    var jdata = arcGetJson(data);
    $('#data').html(jdata.html);
}

function deleteDownload(id) {
    arcAjaxRequest("arcdownload/deleteDownload", {id: id}, null, getDownloads);
}