var kstring;
function getSettings() {
    arcAjaxRequest({action: "settings"}, null, settingsSuccess);
}

function settingsSuccess(data) {
    var jdata = jQuery.parseJSON(JSON.stringify(data));
    $('#data').html(jdata.html);
}

function editSetting(keystring) {
    kstring = keystring;
    arcAjaxRequest({action: "editsetting", key: keystring}, editComplete, editSuccess);
}

function editSuccess(data) {
    var jdata = jQuery.parseJSON(JSON.stringify(data));
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
    arcAjaxRequest({action: "deletesetting", key: kstring}, completeDoDelete, null);
});

function completeDoDelete(data) {
    $("#deleteSetting").modal("hide");
    getSettings();
    updateStatus("status", null);
}

$("#saveSettingBtn").click(function () {
    arcAjaxRequest({action: "savesetting", key: kstring, value: $('#sValue').val()}, completeSave, null);
});

function completeSave(data) {
    $("#editSetting").modal("hide");
    getSettings();
    updateStatus("status", null);
}

$(document).ready(function () {
    getSettings();
});