var userid;
var groupid;
var companyid;

$(document).ready(function() {
    closeUser();
});

function closeUser() {
    arcAjaxRequest("arc/usergetusers", { search: "" }, null, getSuccess);
}

function searchUsers(query) {
    arcAjaxRequest("arc/usergetusers", { search: $("#search").val() }, null, getSuccess);
}

function addUserToGroup(userid) {
    arcAjaxRequest("arc/userchangegroup", { id: userid, group: $("#avGroups").val() }, arcGetStatus, null);
    $('#avGroups option:selected').remove().appendTo('#inGroups');
}

function removeUserFromGroup(userid) {
    arcAjaxRequest("arc/userchangegroup", { id: userid, group: $("#inGroups").val() }, arcGetStatus, null);
    $('#inGroups option:selected').remove().appendTo('#avGroups');
}

$("#removeUserBtn").click(function() {
    arcAjaxRequest("arc/userremove", { id: userid }, remUserComplete, null);
});

function saveUser(userid) {
    arcAjaxRequest("arc/usersave", {
        id: userid,
        firstname: $('#firstname').val(),
        lastname: $('#lastname').val(),
        email: $('#email').val(),
        password: $('#password').val(),
        retype: $('#retype').val(),
        enabled: $("#enabled").val()
    }, saveUserComplete, null);
}

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

function getSuccess(data) {
    var jdata = arcGetJson(data);
    $('#dataTable').html(jdata.html);
}

function getSuccessGroups(data) {
    var jdata = arcGetJson(data);
    $('#groups').html(jdata.html);
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
    arcAjaxRequest("arc/useredit", { id: userid }, null, editUserSuccess);
}

function editUserSuccess(data) {
    var jdata = arcGetJson(data);
    $('#dataTable').html(jdata.html);
}

function removeUser(id) {
    userid = id;
    $("#removeUserModal").modal("show");
}

function remUserComplete() {
    arcAjaxRequest("arc/usergetusers", {}, null, getSuccessUsers);
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
    arcAjaxRequest("arc/usergetgroups", {}, null, getSuccess);
    $("#removeGroupModal").modal("hide");
}

function saveGroupComplete() {
    arcAjaxRequest("arc/usergetgroups", {}, null, getSuccess);
    $("#editGroupModal").modal("hide");
    arcGetStatus();
}

function viewGroups() {
    arcAjaxRequest("arc/usergetgroups", {}, null, getSuccess);
}