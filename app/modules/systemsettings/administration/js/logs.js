function clearLogs() {
    arcAjaxRequest({}, complete, null);
}

function complete() {
    location.reload();
}