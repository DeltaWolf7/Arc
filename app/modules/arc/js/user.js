var userid;
var groupid;

$(document).ready(function () {
    get("users");
});

$("#addGroupBtn").click(function () {
    if ($('#groups').val() != null) {
        arcAjaxRequest("arc/addgroup", {id: userid, group: $('#groups').val()}, addGrpComplete, null);
    }
});

$("#removeFromGroupBtn").click(function () {
    if ($('#groups2').val() != null) {
        arcAjaxRequest("arc/removefromgroup", {id: userid, group: $('#groups2').val()}, remGrpComplete, null);
    }
});

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
    if (action == "users") {
        $("#tabUsers").attr("class", "active");
        $("#tabGroups").removeClass("active");
        arcAjaxRequest("arc/getusers", {}, null, getSuccess);
    } else {
        $("#tabUsers").removeClass("active");
        $("#tabGroups").attr("class", "active");
        arcAjaxRequest("arc/getgroups", {}, null, getSuccess);
    }
}

function getSuccess(data) {
    var jdata = arcGetJson(data);
    $('#data').html(jdata.html);
}

function addGrpComplete() {
    editUser(userid);
}

function remGrpComplete() {
    editUser(userid);
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
    $('#grp2').html(jdata.group);
    $('#company').val(jdata.company);
    $("#enabled").prop('checked', jdata.enabled);
    if (jdata.email == "") {
        $('#email').removeAttr("disabled");
    } else {
        $('#email').attr("disabled", "disabled");
    }
}

function editUserComplete() {
    $("#editUserModal").modal("show");
}

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
    $("#editUserModal").modal("hide");
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