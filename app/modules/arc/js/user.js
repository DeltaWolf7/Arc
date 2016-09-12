var userid;
var groupid;
var companyid;

$(document).ready(function () {
    get("users");
});

$("#addGroupBtn").click(function () {
    arcAjaxRequest("arc/addgroup", {id: userid, group: $('#groups').val()}, addGrpComplete, null);
});

function removeFromGroupBtn(group) {
    arcAjaxRequest("arc/removefromgroup", {id: userid, group: group}, remGrpComplete, null);
}

$("#removeUserBtn").click(function () {
    arcAjaxRequest("arc/remove", {id: userid}, remUserComplete, null);
});

$("#saveUserbtn").click(function () {
    arcAjaxRequest("arc/saveuser", {id: userid, firstname: $('#firstname').val(),
        lastname: $('#lastname').val(), email: $('#email').val(),
        password: $('#password').val(), retype: $('#retype').val(), enabled: $("#enabled").prop("checked"),
        company: $('#company').val()}, saveUserComplete, null);
});

$("#removeGroupDoBtn").click(function () {
    arcAjaxRequest("arc/removegroup", {id: groupid}, removeGrpDoComplete, null);
});

$("#saveGroupBtn").click(function () {
    arcAjaxRequest("arc/savegroup", {id: groupid, name: $('#groupname').val(),
        description: $('#groupdescription').val()}, saveGroupComplete);
});

function get(action) {
    $("#tabUsers").removeClass("active");
    $("#tabGroups").removeClass("active");
    $("#tabCompanies").removeClass("active");
    switch (action) {
        case "users":
            $("#tabUsers").attr("class", "active");
            arcAjaxRequest("arc/getusers", {}, null, getSuccess);
            break;
        case "groups":
            $("#tabGroups").attr("class", "active");
            arcAjaxRequest("arc/getgroups", {}, null, getSuccess);
            break;
        case "companies":
            $("#tabCompanies").attr("class", "active");
            arcAjaxRequest("arc/getcompanies", {}, null, getSuccess);
            break;
    }
}

function getSuccess(data) {
    var jdata = arcGetJson(data);
    $('#data').html(jdata.html);
}

function addGrpComplete() {
    editUser(userid);
    arcGetStatus();
}

function remGrpComplete() {
    editUser(userid);
    arcGetStatus();
}

function editUser(id) {
    userid = id;
    arcAjaxRequest("arc/user", {id: userid}, editUserComplete, editUserSuccess);
}

function editUserSuccess(data) {
    var jdata = arcGetJson(data);
    $('#firstname').val(jdata.firstname);
    $('#lastname').val(jdata.lastname);
    $('#email').val(jdata.email);
    $('#password').val("");
    $('#retype').val("");
    $('#grps').html(jdata.group);
    $('#compgrps').html(jdata.company);
    $("#enabled").prop('checked', jdata.enabled);
    if (jdata.email == "") {
        $('#email').removeAttr("disabled");
    } else {
        $('#email').attr("disabled", "disabled");
    }
}

function editUserComplete() {
    $("#editUserPanel").show();
    $("#mainPanel").hide();
}

$("#closeUserBtn").click(function () {
    $("#editUserPanel").hide();
    $("#mainPanel").show();
});

function removeUser(id) {
    userid = id;
    $("#removeUserModal").modal("show");
}

function remUserComplete() {
    get("users");
    $("#removeUserModal").modal("hide");
}

function saveUserComplete() {
    get("users");
    $("#editUserPanel").hide();
    $("#mainPanel").show();
    arcGetStatus();
}

function editGroup(id) {
    groupid = id;
    arcAjaxRequest("arc/group", {id: groupid}, successEditGroup, completeEditGroup);
}

function completeEditGroup(data) {
    var jdata = arcGetJson(data);
    $("#groupname").val(jdata.name);
    $("#groupdescription").val(jdata.description);
}

function successEditGroup() {
    $("#editGroupModal").modal("show");
}

function removeGroup(id) {
    groupid = id;
    $("#removeGroupModal").modal("show");
}
function removeGrpDoComplete() {
    get("groups");
    $("#removeGroupModal").modal("hide");
}

function saveGroupComplete() {
    get("groups");
    $("#editGroupModal").modal("hide");
    arcGetStatus();
}

function impersonateUser(userid) {
    arcAjaxRequest("arc/impersonateUser", {id: userid}, null, impersonateSuccess);
}

function impersonateSuccess(data) {
    var jdata = arcGetJson(data);
    arcGetStatus();
    if (jdata.status == "success") {
        window.location.href = "/";
    }
}

function editCompany(id) {
    companyid = id;
    arcAjaxRequest("arc/company", {id: companyid}, successEditCompany, completeEditCompany);
}

function completeEditCompany(data) {
    var jdata = arcGetJson(data);
    $("#companyname").val(jdata.name);
}

function successEditCompany() {
    $("#editCompanyModal").modal("show");
}

function removeCompany(id) {
    companyid = id;
    $("#removeCompanyModal").modal("show");
}
function removeCompDoComplete() {
    get("companies");
    $("#removeCompanyModal").modal("hide");
    arcGetStatus();
}

function saveCompanyComplete() {
    get("companies");
    $("#editCompanyModal").modal("hide");
    arcGetStatus();
}

$("#removeCompanyDoBtn").click(function () {
    arcAjaxRequest("arc/removecompany", {id: companyid}, removeCompDoComplete, null);
});

$("#saveCompanyBtn").click(function () {
    arcAjaxRequest("arc/savecompany", {id: companyid, name: $('#companyname').val()}, saveCompanyComplete);
});

function removeCompanyUser(company) {
    arcAjaxRequest("arc/removeCompanyUser", {userid: userid, company: company}, companyUserComplete);
}

function companyUserComplete() {
    editUser(userid);
    arcGetStatus();
}

$("#addCompanyBtn").click(function () {
    arcAjaxRequest("arc/addCompanyUser", {userid: userid, company: $("#companies").val()}, companyUserComplete);
});