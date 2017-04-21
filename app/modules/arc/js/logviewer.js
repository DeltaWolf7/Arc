function clearLogs() {
    arcAjaxRequest("arc/logviewerdelete", {}, update);
}

function update() {
    getLogs();
    arcGetStatus();
}

$(document).ready(function () {
    getLogs();
});

function getLogs() {
    arcAjaxRequest("arc/logviewerget", {}, null, updateView);
}

function updateView(data) {
    var jdata = arcGetJson(data);
    $("#logs").html(jdata.html);
    $("#logTable").DataTable({
        "pageLength": 50,
        "targets": 'no-sort',
        "bSort": false,
        "order": []
    });
}