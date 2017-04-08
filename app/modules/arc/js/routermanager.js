var groupid;
var pid;

$("#savePermissionsBtn").click(function () {
    arcAjaxRequest("arc/routersave",
            {id: pid, group: groupid, route: $("#route").val(), destination: $("#destination").val()},
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
    arcAjaxRequest("arc/routeredit", {id: id}, null, successEdit);
}

function successEdit(data) {
    var jdata = arcGetJson(data);
    $("#edit").html(jdata.data);
    $("#editModal").modal("show");
}

function deletePermission(id) {
    arcAjaxRequest("arc/routerdelete", {id: id}, deleteComplete, null);
}

function deleteComplete() {
    getData();
    arcGetStatus();
}

function getData() {
    arcAjaxRequest("arc/routerget", {}, null, successData);
}

function successData(data) {
    var jdata = arcGetJson(data);
    $("#data").html(jdata.html);
}

$(document).ready(function () {
    getData();
});