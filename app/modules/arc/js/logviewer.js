var page = 0;

function clearLogs() {
    arcAjaxRequest("arc/logviewerdelete", {}, update);
}

function update() {
    getLogs();
    arcGetStatus();
}

$(document).ready(function () {
    getLogs(0);
});

function getLogs(pageNo) {
    page = pageNo;
    arcAjaxRequest("arc/logviewerget", {page: page}, null, updateView);
}

function updateView(data) {
    var jdata = arcGetJson(data);
    $("#logs").html(jdata.html);
}