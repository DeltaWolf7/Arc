// Reset
function resetComplete() {
    updateStatus("status", resetUpdateStatusCallback);
}

function resetUpdateStatusCallback(data) {
    if (data.danger == 0) {
        $("#btnReset").prop("disabled", true);
        $("#password").prop("disabled", true);
        $("#password2").prop("disabled", true);
    }
}

// Reset
    $("#btnReset").click(function () {
        arcAjaxRequest("user/reset", {password: $("#password").val(), password2: $("#password2").val(), id: sid},
                resetComplete, null)
    });