function clearLogs() {
    arcAjaxRequest("system/deletelogs", {}, update);
}

function update() {
    getLogs();
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