// Login
$("#loginBtn").click(function () {
    login();
});

function login() {
    $("#email").prop("disabled", true);
    $("#password").prop("disabled", true);
    $("#loginBtn").prop("disabled", true);
    arcAjaxRequest("arc/login", {email: $("#email").val(), password: $("#password").val()}, showMessage, success);
}

$("#btnForgot").click(function () {
    $('#collapseA').collapse('hide');
    $('#collapseB').collapse('hide');
    $('#collapseC').collapse('show');
});

$("#forgotCancel").click(function () {
    cancelForgot();
});

function showMessage() {
    arcGetStatus();
    $("#email").prop("disabled", false);
    $("#password").prop("disabled", false);
    $("#loginBtn").prop("disabled", false);
}

function cancelForgot() {
    $('#collapseA').collapse('show');
    $('#collapseB').collapse('hide');
    $('#collapseC').collapse('hide');
}

$("#sendReset").click(function () {
    arcAjaxRequest("arc/reset", {emailf: $("#emailf").val()}, arcGetStatus);
    cancelForgot();
});

function success(data) {
    var jdata = arcGetJson(data);
    if (jdata.redirect) {
        window.location = jdata.redirect;
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
    arcAjaxRequest("arc/register", {firstname: $("#firstname").val(), lastname: $("#lastname").val(),
        company: $("#company").val(), emailr: $("#emailr").val(), passwordr: $("#passwordr").val(),
    passwordr2: $("#passwordr2").val()}, arcGetStatus, success);
});

$("#password").keypress(function (e) {
    if (e.keyCode == 13) {
        login();
    }
});
