

// Login
$("#loginBtn").click(function () {
    arcAjaxRequest({action: "login", email: $("#email").val(), password: $("#password").val()}, complete, null);
});

// Register/Login
function complete() {
    updateStatus("status", updateStatusCallback);
}

function updateStatusCallback(data) {
    if (data.danger == 0) {
        //window.location = window.location.protocol + "//" + window.location.host;
    }
}