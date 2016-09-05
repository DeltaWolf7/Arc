$("#btnSaveSettings").click(function () {
    arcAjaxRequest("arc/systemsettingsupdate", {ldap: $("#useLDAP").val(), ldapserver: $("#ldapServer").val(),
        domain: $("#ldapDomain").val(), base: $("#ldapBase").val(), smtp: $("#useSMTP").val(),
        smtpserver: $("#smtpServer").val(), username: $("#smtpUser").val(), password: $("#smtpPass").val(),
        port: $("#smtpPort").val(), sender: $("#smtpSender").val(), defaultPage: $("#defaultPage").val(),
        loginURL: $("#loginURL").val(), width: $("#thumbWidth").val(), theme: $("#theme").val(),
        limit: $("#uploadLimit").val(), days: $("#keepLogsDays").val(), allowReg: $("#allowReg").val(),
        siteLogo: $("#siteLogo").val(), dateFormat: $("#dateFormat").val(), timeFormat: $("#timeFormat").val(),
        company: $("#company").val()}, arcGetStatus);
});

function updateEmail() {
    if ($("#useSMTP").val() == "false") {
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
    if ($("#useLDAP").val() == "false") {
        $("#ldapServer").prop("readonly", true);
        $("#ldapDomain").prop("readonly", true);
        $("#ldapBase").prop("readonly", true);
    } else {
        $("#ldapServer").prop("readonly", false);
        $("#ldapDomain").prop("readonly", false);
        $("#ldapBase").prop("readonly", false);
    }
}

$(document).ready(function () {
    updateEmail();
    updateLDAP();
});