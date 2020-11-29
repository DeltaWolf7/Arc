$(document).ready(function() {
    getGroups();
});

function getGroups() {
    arcAjaxRequest("arc/usergetgroups", {}, null, getSuccess);
}

function getSuccess(data) {
    var jdata = arcGetJson(data);
    $('#groupsData').html(jdata.html);
}

// Save
$("#groupForm").submit(function (e) {
    e.preventDefault();
    arcAjaxRequest("arc/usersavegroup", $(this).serialize(), saveGroupComplete);
});

function saveGroupComplete(data) {
    arcAjaxRequest("arc/usergetgroups", {}, null, getSuccess);
    $("#editGroupModal").modal("hide");
    arcGetStatus();
}

// Remove
function removeGroup(groupid) {
    arcAjaxRequest("arc/userremovegroup", { id: groupid }, getGroups, arcGetStatus);
}

// Edit
function editGroup(id) {
    arcAjaxRequest("arc/usergroup", { id: id }, null, completeEditGroup);
}

function completeEditGroup(data) {
    var jdata = arcGetJson(data);
    $("#groupname").val(jdata.name);
    $("#groupdescription").val(jdata.description);
    $("#groupid").val(jdata.id);
    $("#editGroupModal").modal("show");
}





