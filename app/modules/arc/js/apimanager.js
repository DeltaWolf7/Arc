function saveAPIKey() {
    arcAjaxRequest("arc/apimanagersave", {
        userid: $("#userid").val(),
        key: $("#key").val(),
        secret: $("#secret").val(),
    }, arcGetStatus, arcReload);
}

function deleteAPIKey(id) {
    arcAjaxRequest("arc/apimanagerdelete", {
        id: id,
    }, arcGetStatus, arcReload);
}