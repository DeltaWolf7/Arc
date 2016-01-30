function clearLogs() {
    arcAjaxRequest("system/deletelogs", {}, getLogs, null);
    arcGetStatus();
}

$(document).ready(function () {
    getLogs();
});


function getLogs() {
    arcAjaxRequest("system/getlogs", {}, null, updateView);
}

function updateView(data) {
    var jdata = arcGetJson(data);
    $("#logs").html(jdata.html);
}