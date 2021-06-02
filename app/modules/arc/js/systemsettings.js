$("#btnSaveSettings").click(function() {
    arcAjaxRequest("arc/systemsettingsupdate", {
        ldap: $("#useLDAP").val(),
        ldapserver: $("#ldapServer").val(),
        domain: $("#ldapDomain").val(),
        base: $("#ldapBase").val(),
        smtp: $("#useSMTP").val(),
        smtpserver: $("#smtpServer").val(),
        username: $("#smtpUser").val(),
        password: $("#smtpPass").val(),
        port: $("#smtpPort").val(),
        sender: $("#smtpSender").val(),
        loginURL: $("#loginURL").val(),
        width: $("#thumbWidth").val(),
        theme: $("#theme").val(),
        limit: $("#uploadLimit").val(),
        days: $("#keepLogsDays").val(),
        allowReg: $("#allowReg").val(),
        siteLogo: $("#siteLogo").val(),
        dateFormat: $("#dateFormat").val(),
        timeFormat: $("#timeFormat").val(),
        siteTitle: $("#siteTitle").val(),
        media: $("#mediaManagerURL").val(),
        gAdsense: $("#gAdsense").val(),
        gAnal: $("#gAnal").val()
    }, arcGetStatus);
});

function updateEmail() {
    if ($("#useSMTP").val() == "0") {
        $("#smtpServer").prop("readonly", true);
        $("#smtpUser").prop("readonly", true);
        $("#smtpPass").prop("readonly", true);
        $("#smtpPort").prop("readonly", true);
    } else {
        $("#smtpServer").prop("readonly", false);
        $("#smtpUser").prop("readonly", false);
        $("#smtpPass").prop("readonly", false);
        $("#smtpPort").prop("readonly", false);
    }
}

function updateLDAP() {
    if ($("#useLDAP").val() == "0") {
        $("#ldapServer").prop("readonly", true);
        $("#ldapDomain").prop("readonly", true);
        $("#ldapBase").prop("readonly", true);
    } else {
        $("#ldapServer").prop("readonly", false);
        $("#ldapDomain").prop("readonly", false);
        $("#ldapBase").prop("readonly", false);
    }
}

$(document).ready(function() {
    updateEmail();
    updateLDAP();
    getApikeys();
});

$("#btnMediaManager").click(function() {
    $("#mediaManagerMD").modal("show");
});

function getApikeys() {
    arcAjaxRequest("arc/systemsettingsgetapi", {}, null, displayKeys);
}

function displayKeys(data) {
    var jdata = arcGetJson(data);
    $("#apiKeys").html(jdata.html);
    $("#apiuser").html(jdata.users);
}

function removeApiKey(userid) {
    arcAjaxRequest("arc/systemsettingsremoveapi", { userid: userid }, getApikeys);
    arcGetStatus();
}

$("#createAPI").click(function() {
    arcAjaxRequest("arc/systemsettingscreateapi", { userid: $("#apiuser").val() }, getApikeys);
    arcGetStatus();
});

function copyToClipboardSuccess(data) {
    $("#siteLogo").val(data);
    $("#mediaManagerMD").modal("hide");
}

function copyToClipboard(key) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(key).select();
    document.execCommand("copy");
    $temp.remove();
}