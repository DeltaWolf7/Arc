function searchUsers() {
    arcRedirect("?search=" + $("#usearch").val());
}

function addUserToGroup(userid) {
    arcAjaxRequest("arc/userchangegroup", {
        id: userid,
        group: $("#avGroups").val()
    }, arcGetStatus, null);
    $('#avGroups option:selected').remove().appendTo('#inGroups');
}

function removeUserFromGroup(userid) {
    arcAjaxRequest("arc/userchangegroup", {
        id: userid,
        group: $("#inGroups").val()
    }, arcGetStatus, null);
    $('#inGroups option:selected').remove().appendTo('#avGroups');
}

$("#userForm").submit(function (e) {
    e.preventDefault();
    arcAjaxRequest("arc/usersave", $(this).serialize(), null, userSaved);
});

function userSaved(data) {
    var jdata = arcGetJson(data);
    $("#id").val(jdata.id);
    $("#idtag").html("ID:" + jdata.id);
    arcGetStatus();
}

function getSuccess(data) {
    var jdata = arcGetJson(data);
    $('#dataTable').html(jdata.html);
}

function removeUser(userid) {
    arcAjaxRequest("arc/userremove", {
        id: userid
    }, arcReload(), arcGetStatus());
}

function exportUsers() {
    var url = new URL(window.location.href);
    var search = url.searchParams.get("search");
    var group = url.searchParams.get("groupid");
    if (search != "") {
        arcAjaxRequest("arc/userexport", {
            search: search
        }, null, completeExport);
    } else if (group != "") {
        arcAjaxRequest("arc/userexport", {
            groupid: group
        }, null, completeExport);
    } else {
        arcAjaxRequest("arc/userexport", {
            search: ""
        }, null, completeExport);
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
    arcAjaxRequest("arc/usertoggle", {
        id: id
    }, null, location.reload());
}

function impersonateUser(userid) {
    arcAjaxRequest("arc/userimpersonateuser", {
        id: userid
    }, null, impersonateSuccess);
}

function impersonateSuccess(data) {
    var jdata = arcGetJson(data);
    arcGetStatus();
    if (jdata.status == "success") {
        window.location.href = "/";
    }
}

function viewGroup() {
    if ($("#group").val() == 0) {
        arcRedirect();
    } else {
        arcRedirect("?groupid=" + $("#group").val());
    }
}