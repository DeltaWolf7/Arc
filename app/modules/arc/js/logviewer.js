function clearLogs() {
    arcAjaxRequest("arc/logviewerdelete", {}, update);
}

function update() {
    getLogs();
    arcGetStatus();
}

$(document).ready(function() {
    getLogs();
});

function getLogs() {
    arcAjaxRequest("arc/logviewerget", {}, null, updateView);
}

function updateView(data) {
    var jdata = arcGetJson(data);
    $("#logs").html(jdata.html);
}

function getItem(page) {
    arcAjaxRequest("arc/logviewerget", { page: page}, null, updateView);
}

function searchLogs() {
    arcAjaxRequest("arc/logviewersearch", { query: $("#search").val()}, null, updateView);
}