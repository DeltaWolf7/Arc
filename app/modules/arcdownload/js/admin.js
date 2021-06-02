$(document).ready(function() {
    getDownloads();
});

function getDownloads() {
    arcAjaxRequest("arcdownload/getdownloads", {}, null, getDownloadsComplete);
}

function getDownloadsComplete(data) {
    var jdata = arcGetJson(data);
    $('#data').html(jdata.html);
}

function deleteDownload(id) {
    arcAjaxRequest("arcdownload/deletedownload", {id: id}, null, getDownloads);
}