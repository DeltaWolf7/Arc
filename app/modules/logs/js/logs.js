function clearLogs() {
    arcAjaxRequest("logs/deletelogs", {}, getLogs, null);
    updateStatus("Status");
}

$(document).ready(function () {
    getLogs();
    updateStatus("status");
});


function getLogs() {
    arcAjaxRequest("logs/getlogs", {}, null, updateView);
}

function updateView(data) {
    var jdata = arcGetJson(data);
    $("#logs").html(jdata.html);
}