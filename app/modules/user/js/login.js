// Login
$("#loginBtn").click(function () {
    arcAjaxRequest("user/login", {email: $("#email").val(), password: $("#password").val()}, complete, null);
});

$("#btnForgot").click(function () {
    $('#collapseA').collapse('hide');
    $('#collapseB').collapse('hide');
    $('#collapseC').collapse('show');
});

$("#forgotCancel").click(function () {
    $('#collapseA').collapse('show');
    $('#collapseB').collapse('hide');
    $('#collapseC').collapse('hide');
});

$("#sendReset").click(function () {
    arcAjaxRequest("user/reset", {email: $("#emailf").val()}, completeReset, null);
});

// Register/Login
function completeReset() {
    updateStatus("status");
}

function complete(data) {
    var jdata = arcGetJson(data);
    if (jdata.url != "") {
        window.location = window.location.protocol + "//" + window.location.host + jdata.url;
    }
    updateStatus("status");
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
        email: $("#emailr").val(), password: $("#passwordr").val(), password2: $("#passwordr2").val()},
    complete, null);
});
