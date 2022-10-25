// Login
$("#loginBtn").click(function () {
    login();
});

function login() {
    $("#email").prop("disabled", true);
    $("#password").prop("disabled", true);
    $("#loginBtn").prop("disabled", true);
    arcAjaxRequest("arc/dologin", {
        email: $("#email").val(),
        password: $("#password").val(),
        redirect: $("#redirect").val()
    }, showMessage, success);
}

$("#btnReg").click(function () {
    toggleView("reg");
});

$("#btnBackLogin").click(function () {
    toggleView("login");
});

$("#btnForgot").click(function () {
    toggleView("forgot");
});

$("#forgotCancel").click(function () {
    cancelForgot();
});

function toggleView(item) {
    $('#collapseA').collapse('hide');
    $('#collapseB').collapse('hide');
    $('#collapseC').collapse('hide');

    switch (item) {
        case "login":
            $('#collapseA').collapse('show');
            break;
        case "reg":
            $('#collapseB').collapse('show');
            break;
        case "forgot":
            $('#collapseC').collapse('show');
            break;
    }
}

function showMessage() {
    arcGetStatus();
    $("#email").prop("disabled", false);
    $("#password").prop("disabled", false);
    $("#loginBtn").prop("disabled", false);
}

function cancelForgot() {
    toggleView("login");
}

$("#sendReset").click(function () {
    arcAjaxRequest("arc/reset", {
        emailf: $("#emailf").val()
    }, arcGetStatus);
});

function success(data) {
    var jdata = arcGetJson(data);
    if (jdata.redirect) {
        window.location = jdata.redirect;
    }
}

// Register
$("#registerBtn").click(function () {
    arcAjaxRequest("arc/doregister", {
        firstname: $("#firstname").val(),
        lastname: $("#lastname").val(),
        emailr: $("#emailr").val(),
        passwordr: $("#passwordr").val(),
        passwordr2: $("#passwordr2").val()
    }, arcGetStatus, success);
});

$("#password").keypress(function (e) {
    if (e.keyCode == 13) {
        login();
    }
});


//hide password
$(document).ready(function () {
    $("#show_hide_password a").on('click', function (event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bx-hide");
            $('#show_hide_password i').removeClass("bx-show");
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bx-hide");
            $('#show_hide_password i').addClass("bx-show");
        }
    });
});