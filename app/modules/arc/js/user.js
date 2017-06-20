var userid;
var groupid;
var companyid;

$(document).ready(function() {
    arcAjaxRequest("arc/usergetusers", {}, null, getSuccessUsers);
});

function addUserToGroup(id, group) {
    arcAjaxRequest("arc/userchangegroup", { id: id, group: group }, arcGetStatus, null);
}

$("#removeUserBtn").click(function() {
    arcAjaxRequest("arc/userremove", { id: userid }, remUserComplete, null);
});

$("#saveUserbtn").click(function() {
    arcAjaxRequest("arc/usersave", {
        id: userid,
        firstname: $('#firstname').val(),
        lastname: $('#lastname').val(),
        email: $('#email').val(),
        password: $('#password').val(),
        retype: $('#retype').val(),
        enabled: $("#enabled").val()
    }, saveUserComplete, null);
});

$("#removeGroupDoBtn").click(function() {
    arcAjaxRequest("arc/userremovegroup", { id: groupid }, removeGrpDoComplete, null);
});

$("#saveGroupBtn").click(function() {
    arcAjaxRequest("arc/usersavegroup", {
        id: groupid,
        name: $('#groupname').val(),
        description: $('#groupdescription').val()
    }, saveGroupComplete);
});

$("#tabUsers").click(function() {
    arcAjaxRequest("arc/usergetusers", {}, null, getSuccessUsers);
});

$("#tabGroups").click(function() {
    arcAjaxRequest("arc/usergetgroups", {}, null, getSuccessGroups);
});

$("#tabCompanies").click(function() {
    arcAjaxRequest("arc/usergetcompanies", {}, null, getSuccessCompanies);
});

function getSuccessUsers(data) {
    var jdata = arcGetJson(data);
    $('#users').html(jdata.html);
}

function getSuccessGroups(data) {
    var jdata = arcGetJson(data);
    $('#groups').html(jdata.html);
}

function getSuccessCompanies(data) {
    var jdata = arcGetJson(data);
    $('#companies').html(jdata.html);
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
    arcAjaxRequest("arc/useredit", { id: userid }, editUserComplete, editUserSuccess);
}

function editUserSuccess(data) {
    var jdata = arcGetJson(data);
    $('#firstname').val(jdata.firstname);
    $('#lastname').val(jdata.lastname);
    $('#email').val(jdata.email);
    $('#password').val("");
    $('#retype').val("");
    $('#usrgroups').html(jdata.groups);
    $("#enabled").val(jdata.enabled);
}

function editUserComplete() {
    $("#editUserPanel").show();
    $("#mainPanel").hide();
}

$("#closeUserBtn").click(function() {
    $("#editUserPanel").hide();
    $("#mainPanel").show();
});

function removeUser(id) {
    userid = id;
    $("#removeUserModal").modal("show");
}

function remUserComplete() {
    arcAjaxRequest("arc/usergetusers", {}, null, getSuccessUsers);
    $("#removeUserModal").modal("hide");
}

function saveUserComplete() {
    arcAjaxRequest("arc/usergetusers", {}, null, getSuccessUsers);
    arcGetStatus();
}

function editGroup(id) {
    groupid = id;
    arcAjaxRequest("arc/usergroup", { id: groupid }, successEditGroup, completeEditGroup);
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
    arcAjaxRequest("arc/usergetgroups", {}, null, getSuccessGroups);
    $("#removeGroupModal").modal("hide");
}

function saveGroupComplete() {
    arcAjaxRequest("arc/usergetgroups", {}, null, getSuccessGroups);
    $("#editGroupModal").modal("hide");
    arcGetStatus();
}