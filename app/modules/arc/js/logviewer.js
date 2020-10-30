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

function getItemUser(page) {
    arcAjaxRequest("arc/logviewersearch", { user: $("#userS").val(), page: page}, null, updateView);
}

function searchLogs() {
    arcAjaxRequest("arc/logviewersearch", { query: $("#search").val()}, null, updateView);
}

function userSelect() {
    if ($("#userS").val() != 0) {
        arcAjaxRequest("arc/logviewersearch", { user: $("#userS").val(), page: 0 }, null, updateView);
    }
}