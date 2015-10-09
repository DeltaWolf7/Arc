// Session
var sid = "";
function setSID(id) {
    sid = id;
}

$(document).ready(function () {
    // Details
    $("#saveDetailsBtn").click(function () {
        arcAjaxRequest({arcid: sid,
            firstname: $("#firstname").val(), lastname: $("#lastname").val(),
            password: $("#password").val(), password2: $("#password2").val()}, detailsComplete, null);
    });

    // Register
    $("#registerBtn").click(function () {
        arcAjaxRequest({firstname: $("#firstname").val(), lastname: $("#lastname").val(), email: $("#email").val(), password: $("#password").val(), password2: $("#password2").val()},
        complete, null);
    });

    // Login
    $("#loginBtn").click(function () {
        arcAjaxRequest({email: $("#email").val(), password: $("#password").val()}, complete, null);
    });

    // Reset
    $("#btnReset").click(function () {
        arcAjaxRequest({password: $("#password").val(), password2: $("#password2").val(), id: sid}, resetComplete, null)
    });
    
    // Forgot
    $("#forgotBtn").click(function () {
        arcAjaxRequest({email: $("#email").val()}, forgotComplete, null);
    });
});

// Details
function detailsComplete() {
    updateStatus("status", null);
}

// Register/Login
function complete() {
    updateStatus("status", updateStatusCallback);
}

function updateStatusCallback(data) {
    if (data.danger == 0) {
        window.location = window.location.protocol + "//" + window.location.host;
    }
}

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
