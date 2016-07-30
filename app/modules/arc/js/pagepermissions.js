var groupid;
var pid;

$("#savePermissionsBtn").click(function () {
    arcAjaxRequest("arc/pagepermissionssave",
            {id: pid, group: groupid, module: $("#module").val()},
            saveComplete, null);
});

function saveComplete() {
    $("#editModal").modal("hide");
    getData();
    arcGetStatus();
}

function editPermission(group, id) {
    groupid = group;
    pid = id;
    arcAjaxRequest("arc/pagepermissionsedit", {id: id}, null, successEdit);
}

function successEdit(data) {
    var jdata = arcGetJson(data);
    $("#edit").html(jdata.data);
    $("#editModal").modal("show");
}

function deletePermission(id) {
    arcAjaxRequest("arc/pagepermissionsdelete", {id: id}, deleteComplete, null);
}

function deleteComplete() {
    getData();
    arcGetStatus();
}

function getData() {
    arcAjaxRequest("arc/pagepermissionsget", {}, null, successData);
}

function successData(data) {
    var jdata = arcGetJson(data);
    $("#data").html(jdata.html);
}

$(document).ready(function () {
    getData();
});