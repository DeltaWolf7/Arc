taskid = 0;

function edit(id) {
    taskid = id;
    arcAjaxRequest("taskmaster/getTask", {id: id}, null, editSuccess);
}

function editSuccess(data) {
    var jdata = arcGetJson(data);
    $('#created').data("DateTimePicker").date(jdata.created);
    $('#due').data("DateTimePicker").date(jdata.due);
    $("#description").val(jdata.description);
    $("#tags").val(jdata.tags);
    $("#assign").val(jdata.owner);
    $("#stat").val(jdata.status);
    $("#hours").val(jdata.hours);
    $("#editModal").modal('show');
}

function getAllTasks() {
    arcAjaxRequest("taskmaster/getAllTasks", {}, null, dataUpdate);
}

function getStatusTasks(status) {
    arcAjaxRequest("taskmaster/getStatusTasks", {status: status}, null, dataUpdate);
}

function getTasksByUser(status) {
    arcAjaxRequest("taskmaster/getUserTasks", {status: status}, null, dataUpdate);
}

function dataUpdate(data) {
    var jdata = arcGetJson(data);
    $("#data").html(jdata.html);
}

$("#searchBtn").click(function () {
    arcAjaxRequest("taskmaster/doSearch", {search: $("#search").val()}, null, dataUpdate);
    $("#search").val("");
});

$("#saveBtn").click(function () {
    var dateValue = "0000-00-00 00:00:00";
    if ($('#due').data("DateTimePicker").date() != null) {
        dateValue = $('#due').data("DateTimePicker").date().format("YYYY-MM-DD HH:mm:ss");
    }
    arcAjaxRequest("taskmaster/saveTask", {due: dateValue,
        description: $("#description").val(), tags: $("#tags").val(), owner: $("#assign").val(), status: $("#stat").val(),
        id: taskid, hours: $("#hours").val()}, saveUpdate, null);
});

$("#saveSettingsBtn").click(function () {
    arcAjaxRequest("taskmaster/saveSettings", {emails: $("#emails").val()}, saveSettings, null);
});

function saveUpdate() {
    $("#editModal").modal('hide');
    arcGetStatus();
}

function saveSettings() {
    $("#settingsModal").modal('hide');
    arcGetStatus();
}

$("#sendBtn").click(function() {
    arcAjaxRequest("taskmaster/sendmail", {}, arcGetStatus, null);
});

$("#settingsBtn").click(function() {
    arcAjaxRequest("taskmaster/getSettings", {}, null, settingsSuccess);
});

function settingsSuccess(data) {
    var jdata = arcGetJson(data);
    $("#emails").val(jdata.emails);
    $("#settingsModal").modal('show');
}

$(document).ready(function () {
    $('#created').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        sideBySide: true
    });
    $('#due').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        sideBySide: true
    });

    getTasksByUser("New");
});