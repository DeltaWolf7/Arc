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
        arcAjaxRequest({email: $("#email").val()}, forgotComplete, null);
    });
    
    