// Register
$("#registerBtn").click(function () {
    arcAjaxRequest("user/register", {firstname: $("#firstname").val(), lastname: $("#lastname").val(),
        email: $("#email").val(), password: $("#password").val(), password2: $("#password2").val()},
            complete, null);
});

// Register/Login
function complete() {
    updateStatus("status", updateStatusCallback);
}

function updateStatusCallback(data) {
    if (data.danger == 0) {
        window.location = window.location.protocol + "//" + window.location.host;
    }
}