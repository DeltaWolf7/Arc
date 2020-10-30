var userid;
var groupid;
var contactid;
var linkid;
var searchVar = "";
var groupVar = "";

$(document).ready(function() {
    closeUser();
});

function closeUser() {
    if (searchVar != "") {
        arcAjaxRequest("arc/usergetusers", { search: searchVar }, null, getSuccess);
    } else if (groupVar != "") {
        arcAjaxRequest("arc/usergetusers", { groupid: groupVar }, null, getSuccess);
    } else {
        arcAjaxRequest("arc/usergetusers", { search: "" }, null, getSuccess);
    }
}

function searchUsers(query) {
    searchVar = query;
    groupVar = "";
    closeUser();
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
        enabled: $("#enabled").val(),
        company: $("#company").val(),
        source: $("#source").val(),
        addresslines: $("#addresslines").val(),
        county: $("#county").val(),
        postcode: $("#postcode").val(),
        country: $("#country").val(),
        phone: $("#phone").val(),
        notes: $("#notes").val()
    }, null, saveUserComplete);
}

function saveUserComplete(data) {
    var jdata = arcGetJson(data);
    if (userid == 0) {
        editUser(jdata.id);
    }
    arcGetStatus()
}

$("#removeGroupDoBtn").click(function() {
    arcAjaxRequest("arc/userremovegroup", { id: groupid }, doEditComplete, null);
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
    closeUser();
    $("#removeUserModal").modal("hide");
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

function doEditComplete() {
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

$("#saveContactBtn").click(function() {
    arcAjaxRequest("arc/usersavecontact", {
        id: contactid,
        name: $('#contactname').val(),
        title: $('#contacttitle').val(),
        email: $('#contactemail').val(),
        phone: $('#contactphone').val(),
        userid: userid
    }, saveContactComplete);
});

function saveContactComplete() {
    editUser(userid);
    $("#editContactModal").modal("hide");
    arcGetStatus();
}

function editContact(id) {
    contactid = id;
    arcAjaxRequest("arc/usereditcontact", { id: contactid }, editContactSuccess, completeEditContact);
}

function editContactSuccess(data) {
    $("#editContactModal").modal("show");
}

function completeEditContact(data) {
    var jdata = arcGetJson(data);
    $("#contactname").val(jdata.name);
    $("#contacttitle").val(jdata.title);
    $("#contactemail").val(jdata.email);
    $("#contactphone").val(jdata.phone);
}

function removeContact(id) {
    contactid = id;
    arcAjaxRequest("arc/userremovecontact", { id: contactid }, null, doEditComplete);
}

function doEditComplete() {
    editUser(userid);
    arcGetStatus();
}

function removeLink(id) {
    console.log(id);
    arcAjaxRequest("arc/userremovelink", { id: id }, null, doEditComplete);
}

function editLink(id) {
    $("#editLinkModal").modal("show");
}

function searchLink() {
    arcAjaxRequest("arc/userlinksearch", { search: $("#linkSearch").val() }, null, completeSearchLink);
}

function completeSearchLink(data) {
    var jdata = arcGetJson(data);
    $("#linksearchresults").html(jdata.html);
}

function addLink(linkid) {
    arcAjaxRequest("arc/useraddlink", { userid: userid, linkid: linkid }, null, doEditComplete);
}

function exportUsers() {
    if (searchVar != "") {
        arcAjaxRequest("arc/userexport", { search: searchVar }, null, completeExport);
    } else if (groupVar != "") {
        arcAjaxRequest("arc/userexport", { groupid: groupVar }, null, completeExport);
    } else {
        arcAjaxRequest("arc/userexport", { search: "" }, null, completeExport);
    }
}

function completeExport(data) {
    var jdata = arcGetJson(data);
    download("export.csv", jdata.data);
}

function download(filename, text) {
    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);
    element.style.display = 'none';
    document.body.appendChild(element);
    element.click(); 
    document.body.removeChild(element);
}

function toggleEnable(id) {
    arcAjaxRequest("arc/usertoggle", { id: id }, null, closeUser);
}

function displayUsers() {
    arcAjaxRequest("arc/usersdisplay", { }, null, getSuccess);
}

function impersonateUser(userid) {
    arcAjaxRequest("arc/userimpersonateuser", {id: userid}, null, impersonateSuccess);
}

function impersonateSuccess(data) {
    var jdata = arcGetJson(data);
    arcGetStatus();
    if (jdata.status == "success") {
        window.location.href = "/";
    }
}

function viewGroup(groupid) {
    groupVar = groupid;
    searchVar = "";
    closeUser();
}

function clearUsers() {
    groupVar = "";
    searchVar = "";
    closeUser();
}