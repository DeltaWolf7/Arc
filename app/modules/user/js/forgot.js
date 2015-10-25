// Forgot
function forgotComplete() {
    updateStatus("status", forgotUpdateStatusCallback);
}

function forgotUpdateStatusCallback(data) {
    if (data.danger == 0) {
        $("#email").prop("disabled", true);
        $("#forgotBtn").prop("disabled", true);
    }
}

// Forgot
    $("#forgotBtn").click(function () {
        arcAjaxRequest("user/forgot", {email: $("#email").val()}, forgotComplete, null);
    });
    
    