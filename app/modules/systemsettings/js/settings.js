var kstring;

function getSettings() {
    arcAjaxRequest("systemsettings/getsettings", {}, null, settingsSuccess);
}

function settingsSuccess(data) {
    var jdata = arcGetJson(data);
    $('#data').html(jdata.html);
}

function editSetting(keystring) {
    kstring = keystring;
    arcAjaxRequest("systemsettings/editsetting", {key: keystring}, editComplete, editSuccess);
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
    arcAjaxRequest("systemsettings/deletesetting", {key: kstring}, completeDoDelete, null);
});

function completeDoDelete(data) {
    $("#deleteSetting").modal("hide");
    getSettings();
    updateStatus("status");
}

$("#saveSettingBtn").click(function () {
    arcAjaxRequest("systemsettings/savesetting", {key: kstring, value: $('#sValue').val()}, completeSave, null);
});

function completeSave(data) {
    $("#editSetting").modal("hide");
    getSettings();
    updateStatus("status");
}

$(document).ready(function () {
    getSettings();
});