$(document).ready(function () {
    arcAjaxRequest("servicemanager/getServices", {}, null, successGet);
});

function successGet(data) {
    var jdata = arcGetJson(data);
    $("#data").html(jdata.html);
}