function clearLogs() {
    arcAjaxRequest("system/deletelogs", {}, getLogs, null);
    updateStatus("Status");
}

$(document).ready(function () {
    getLogs();
    updateStatus("status");
    $('[data-toggle="tooltip"]').tooltip();
});


function getLogs() {
    arcAjaxRequest("system/getlogs", {}, null, updateView);
}

function updateView(data) {
    var jdata = arcGetJson(data);
    $("#logs").html(jdata.html);
}