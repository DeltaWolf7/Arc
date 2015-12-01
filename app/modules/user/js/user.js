var userid;
var groupid;

$(document).ready(function () {
    get("users");
});

$("#addGroupBtn").click(function () {
    if ($('#groups').val() != null) {
        arcAjaxRequest("user/addgroup", {id: userid, group: $('#groups').val()}, addGrpComplete, null);
        updateStatus("status");
    }
});

$("#removeFromGroupBtn").click(function () {
    if ($('#groups2').val() != null) {
        arcAjaxRequest("user/removefromgroup", {id: userid, group: $('#groups2').val()}, remGrpComplete, null);
        updateStatus("status");
    }
});

$("#removeUserBtn").click(function () {
    arcAjaxRequest("user/remove", {id: userid}, remUserComplete, null);
});

$("#saveUserbtn").click(function () {
    arcAjaxRequest("user/saveuser", {id: userid, firstname: $('#firstname').val(),
        lastname: $('#lastname').val(), email: $('#email').val(),
        password: $('#password').val(), retype: $('#retype').val(), enabled: $("#enabled").prop("checked")}, saveUserComplete, null);
    updateStatus("status");
});

$("#removeGroupDoBtn").click(function () {
    arcAjaxRequest("user/removegroup", {id: groupid}, removeGrpDoComplete, null);
    updateStatus("status");
});

$("#saveGroupBtn").click(function () {
    arcAjaxRequest("user/savegroup", {id: groupid, name: $('#groupname').val(),
        description: $('#groupdescription').val()}, saveGroupComplete);
    updateStatus("status");
});

function get(action) {
    if (action == "users") {
        $("#tabUsers").attr("class", "active");
        $("#tabGroups").removeClass("active");
        arcAjaxRequest("user/getusers", {}, null, getSuccess);
    } else {
        $("#tabUsers").removeClass("active");
        $("#tabGroups").attr("class", "active");
        arcAjaxRequest("user/getgroups", {}, null, getSuccess);
    }
}

function getSuccess(data) {
    var jdata = arcGetJson(data);
    $('#data').html(jdata.html);
}

function addGrpComplete(data) {
    editUser(userid);
}

function remGrpComplete(data) {
    editUser(userid);
}

function editUser(id) {
    userid = id;
    arcAjaxRequest("user/user", {id: userid}, editUserComplete, editUserSuccess);
}

function editUserSuccess(data) {
    var jdata = arcGetJson(data);
    $('#firstname').val(jdata.firstname);
    $('#lastname').val(jdata.lastname);
    $('#email').val(jdata.email);
    $('#password').val("");
    $('#retype').val("");
    $('#grp2').html(jdata.group);
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
}

function editGroup(id) {
    groupid = id;
    arcAjaxRequest("user/group", {id: groupid}, successEditGroup, completeEditGroup);
}

function completeEditGroup(data) {
    var jdata = arcGetJson(data);
    $("#groupname").val(jdata.name);
    $("#groupdescription").val(jdata.description);
}

function successEditGroup(data) {
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

function saveGroupComplete(data) {
    get("groups");
    $("#editGroupModal").modal("hide");
}