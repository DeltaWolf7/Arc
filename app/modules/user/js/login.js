// Login
$("#loginBtn").click(function () {
    arcAjaxRequest("user/login", {
        email: $("#email").val(),
        password: $("#password").val()
    }, complete, null);
});

$("#forgotBtn").click(function () {
    alert("not implemented")
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


// Login effects
var sview = false;
function switchView() {
    if (sview == false) {
        sview = true;
        $('#collapseA').collapse('hide');
        $('#collapseB').collapse('show');
    } else {
        sview = false;
        $('#collapseA').collapse('show');
        $('#collapseB').collapse('hide');
    }
}


// Register
$("#registerBtn").click(function () {
    arcAjaxRequest("user/register", {firstname: $("#firstname").val(), lastname: $("#lastname").val(),
        email: $("#email").val(), password: $("#password").val(), password2: $("#password2").val()},
            complete, null);
});
