var kstring;

function getSettings() {
    arcAjaxRequest("systemsettings/getusersettings", {userid: $("#userid").val()}, null, settingsSuccess);
}

function settingsSuccess(data) {
    var jdata = arcGetJson(data);
    $('#data').html(jdata.html);
}

function editSetting(keystring) {
    kstring = keystring;
    arcAjaxRequest("systemsettings/editusersetting", {key: keystring, userid: $("#userid").val()}, editComplete, editSuccess);
}

function editSuccess(data) {
    var jdata = arcGetJson(data);
    $('#sKey').val(jdata.skey);
    $('#sValue').val(jdata.svalue);
}

function editComplete(data) {
    $("#editSetting").modal("show");
}

function deleteSetting(keystring) {
    kstring = keystring;
    $("#deleteSetting").modal("show");
}

$("#doDeleteBtn").click(function () {
    arcAjaxRequest("systemsettings/deleteusersetting", {key: kstring, userid: $("#userid").val()}, completeDoDelete, null);
});

function completeDoDelete(data) {
    $("#deleteSetting").modal("hide");
    getSettings();
    updateStatus("status");
}

$("#saveSettingBtn").click(function () {
    arcAjaxRequest("systemsettings/saveusersetting", {key: kstring, value: $('#sValue').val(), userid: $("#userid").val()}, completeSave, null);
});

function completeSave(data) {
    $("#editSetting").modal("hide");
    getSettings();
    updateStatus("status");
}

$(document).ready(function () {
    getSettings();
});