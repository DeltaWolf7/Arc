$(document).ready(function () {
    $(".be-left-sidebar").hide();
    $(".navbar").hide();
    $(".be-content").css({'margin-left': '0px'});
    $(".main-content").css({'margin-left': '0px'});
    $(".be-wrapper").css({'padding-top': '0px'});
    $(".page-head").hide();
});

$("#btnRegsiter").click(function () {
    $("#loginDiv").hide();
    $("#forgotDiv").hide();
    $("#registerDiv").show();
});

$("#cancelBtn").click(function () {
    resetLogin();
});

$("#cancelBtn2").click(function () {
    resetLogin();
});

function resetLogin() {
    $("#loginDiv").show();
    $("#forgotDiv").hide();
    $("#registerDiv").hide();
}

$("#btnForgot").click(function () {
    $("#loginDiv").hide();
    $("#forgotDiv").show();
    $("#registerDiv").hide();
});

$("#sendReset").click(function () {
    resetLogin();
});