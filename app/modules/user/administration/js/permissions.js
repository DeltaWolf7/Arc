var groupid;
var pid;

$("#savePermissionsBtn").click(function () {
    arcAjaxRequest({action: "savepermission", id: pid, group: groupid, module: $("#module").val()}, null, null);
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
    arcAjaxRequest({action: "editpermission", id: id}, null, successEdit);
}

function successEdit(data) {
    var jdata = jQuery.parseJSON(JSON.stringify(data));
    $("#edit").html(jdata.data);
    $("#editModal").modal("show");
}

function deletePermission(id) {
    arcAjaxRequest({action: "deletepermission", id: id}, null, null);
    updateStatus("status", null);
    getData();
}

function getData() {
    arcAjaxRequest({action: "getdata"}, null, successData);
}

function successData(data) {
    var jdata = jQuery.parseJSON(JSON.stringify(data));
    $("#data").html(jdata.data);
}

$(document).ready(function () {
        getData();
    });