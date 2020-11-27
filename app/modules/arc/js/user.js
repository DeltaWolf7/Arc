function searchUsers() {
    window.location = window.location.href.split('?')[0] + "?search=" + searchVar;
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

$("#userForm").submit(function(e) {
    e.preventDefault();
    arcAjaxRequest("arc/usersave", $(this).serialize(), null, userSaved);
});

function userSaved(data) {
    var jdata = arcGetJson(data);
    window.location = window.location.href.split('?')[0] + "/" + jdata.id;
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

function removeUser(id) {
    $("#removeUserModal").modal("show");
}

function remUserComplete() {
    closeUser();
    $("#removeUserModal").modal("hide");
}

function editGroup(id) {
    arcAjaxRequest("arc/usergroup", { id: id }, successEditGroup, completeEditGroup);
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

function exportUsers() {
    var url = new URL(window.location.href);
    var search = url.searchParams.get("search");
    var group = url.searchParams.get("groupid");
    if (search != "") {
        arcAjaxRequest("arc/userexport", { search: search }, null, completeExport);
    } else if (group != "") {
        arcAjaxRequest("arc/userexport", { groupid: group }, null, completeExport);
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
    arcAjaxRequest("arc/usertoggle", { id: id }, null, location.reload());
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
    //window.location = window.location.href.split('?')[0] + "?groupid=" + groupid;
console.log(arcGetPath(1));

}