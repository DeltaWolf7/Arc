var groupid;
var pid;

$("#savePermissionsBtn").click(function () {
    arcAjaxRequest("pagemanager/savepermission",
            {id: pid, group: groupid, module: $("#module").val()},
            saveComplete, null);
});

function saveComplete() {
    $("#editModal").modal("hide");
    getData();
    updateStatus("status");
}

function editPermission(group, id) {
    groupid = group;
    pid = id;
    arcAjaxRequest("pagemanager/editpermisson", {id: id}, null, successEdit);
}

function successEdit(data) {
    var jdata = arcGetJson(data);
    $("#edit").html(jdata.data);
    $("#editModal").modal("show");
}

function deletePermission(id) {
    arcAjaxRequest("pagemanager/deletepermission", {id: id}, deleteComplete, null);
}

function deleteComplete() {
    getData();
    updateStatus("status");
}

function getData() {
    arcAjaxRequest("pagemanager/getpermissions", {}, null, successData);
}

function successData(data) {
    var jdata = arcGetJson(data);
    $("#data").html(jdata.html);
}

$(document).ready(function () {
    getData();
});