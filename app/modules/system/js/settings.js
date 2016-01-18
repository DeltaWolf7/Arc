function saveKeepLogsDays() {
    arcAjaxRequest("system/savedays", {days: $("#keepLogsDays").val()}, null, updateStatus("status"));
}

function saveUploadLimit() {
    arcAjaxRequest("system/saveuploadlimit", {limit: $("#uploadLimit").val()}, null, updateStatus("status"));
}

function saveTheme() {
    arcAjaxRequest("system/savetheme", {theme: $("#theme").val()}, null, updateStatus("status"));
}

function saveThumbWidth() {
    arcAjaxRequest("system/savethumbwidth", {width: $("#thumbWidth").val()}, null, updateStatus("status"));
}

function saveLoginURL() {
    arcAjaxRequest("system/saveloginurl", {url: $("#loginURL").val()}, null, updateStatus("status"));
}

function saveDefaultPage() {
    arcAjaxRequest("system/savedefaultpage", {url: $("#defaultPage").val()}, null, updateStatus("status"));
}

function saveEmail() {
    arcAjaxRequest("system/saveemail", {smtp: $("#useSMTP").val(), server: $("#smtpServer").val(),
    username: $("#smtpUser").val(), password: $("#smtpPass").val(), port: $("#smtpPort").val(),
    sender: $("#smtpSender").val()}, null, updateStatus("status"));
}

function updateEmail() {
    if ($("#useSMTP").val() == "false") {
        $("#smtpServer").prop("readonly", true);
        $("#smtpUser").prop("readonly", true);
        $("#smtpPass").prop("readonly", true);
        $("#smtpPort").prop("readonly", true);
        $("#smtpSender").prop("readonly", true);
    } else {
        $("#smtpServer").prop("readonly", false);
        $("#smtpUser").prop("readonly", false);
        $("#smtpPass").prop("readonly", false);
        $("#smtpPort").prop("readonly", false);
        $("#smtpSender").prop("readonly", false);
    }
}

$(document).ready(function () {
    arcAjaxRequest("system/getsettings", {}, null, settingsSuccess);
});

function settingsSuccess(data) {
    var jdata = arcGetJson(data);
    $('#data').html(jdata.html);
    updateEmail();
}