var userid;
var groupid;

$(document).ready(function () {
    get("users");

    $("#addGroupBtn").click(function () {
        if ($('#groups').val() != null) {
            arcAjaxRequest({action: "addgroup", id: userid, group: $('#groups').val()}, addGrpComplete, null);
            updateStatus("status", null);
        }
    });

    $("#removeFromGroupBtn").click(function () {
        if ($('#groups2').val() != null) {
            arcAjaxRequest({action: "removefromgroup", id: userid, group: $('#groups2').val()}, remGrpComplete, null);
            updateStatus("status", null);
        }
    });

    $("#removeUserBtn").click(function () {
        arcAjaxRequest({id: userid, action: "remove"}, remUserComplete, null);
    });

    $("#saveUserbtn").click(function () {
        arcAjaxRequest({action: "saveuser", id: userid, firstname: $('#firstname').val(),
            lastname: $('#lastname').val(), email: $('#email').val(),
            password: $('#password').val(), retype: $('#retype').val(), enabled: $("#enabled").prop("checked")}, saveUserComplete, null);
        updateStatus("status", updateStatusCallback);
    });

    $("#removeGroupDoBtn").click(function () {
        arcAjaxRequest({id: groupid, action: "removegroup"}, removeGrpDoComplete, null);
        updateStatus("status", null);
    });

    $("#saveGroupBtn").click(function () {
        arcJaxRequest({action: "savegroup", id: groupid, name: $('#groupname').val(),
            description: $('#groupdescription').val()}, saveGroupComplete, null);
        updateStatus("status", updateStatusCallback2);
    });
});

function get(action) {
    if (action == "users") {
        $("#tabUsers").attr("class", "active");
        $("#tabGroups").removeClass("active");
    } else {
        $("#tabUsers").removeClass("active");
        $("#tabGroups").attr("class", "active");
    }
    arcAjaxRequest({action: action}, null, getSuccess);
}

function getSuccess(data) {
    var jdata = jQuery.parseJSON(JSON.stringify(data));
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
    arcAjaxRequest({action: "user", id: userid}, editUserComplete, editUserSuccess);
}

function editUserSuccess(data) {
    var jdata = jQuery.parseJSON(JSON.stringify(data));
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
}

function updateStatusCallback(data) {
    if (data.danger == 0) {
        $("#editUserModal").modal("hide");
    }
}

function editGroup(id) {
    groupid = id;
    arcAjaxRequest({action: "group", id: groupid}, completeEditGroup, successEditGroup);
}

function completeEditGroup(data) {
    var jdata = jQuery.parseJSON(JSON.stringify(data));
    $('#groupname').val(jdata.name);
    $('#groupdescription').val(jdata.description);
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

function saveGroupComplete() {
    get("groups");
}

function updateStatusCallback2(data) {
    if (data.status == "success") {
        $("#editGroupModal").modal("hide");
    }
}