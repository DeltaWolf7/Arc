function clearLogs() {
    arcAjaxRequest("logs/deletelogs", {}, getLogs, null);
}

$(document).ready(function () {
    getLogs();
});


function getLogs() {
    arcAjaxRequest("logs/getlogs", {}, null, updateView);
}

function updateView(data) {
    var jdata = arcGetJson(data);
    $("#logs").html(jdata.html);
}