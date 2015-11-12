var groupid;
var pid;

$("#savePermissionsBtn").click(function () {
    arcAjaxRequest("usermanager/savepermission", {id: pid, group: groupid, module: $("#module").val()}, null, null);
    updateStatus("status", updateStatusCallback3);
});

function updateStatusCallback3(data) {
    if (data.danger == 0) {
        $("#editModal").modal("hide");
        getData();
    }
}

function editPermission(group, id) {
    groupid = group;
    pid = id;
    arcAjaxRequest("usermanager/editpermisson", {id: id}, null, successEdit);
}

function successEdit(data) {
    var jdata = arcGetJson(data);
    $("#edit").html(jdata.data);
    $("#editModal").modal("show");
}

function deletePermission(id) {
    arcAjaxRequest("usermanager/deletepermisson", {id: id}, null, null);
    updateStatus("status", null);
    getData();
}

function getData() {
    arcAjaxRequest("usermanager/getdata", {}, null, successData);
}

function successData(data) {
    var jdata = arcGetJson(data);
    $("#data").html(jdata.data);
}

$(document).ready(function () {
        getData();
    });