$(document).ready(function () {
    $(".be-left-sidebar").hide();
    $(".navbar").hide();
    $(".be-content").css({'margin-left': '0px'});
    $(".main-content").css({'margin-left': '0px'});
    $(".be-wrapper").css({'padding-top': '0px'});
    $(".page-head").hide();
});

$("#btnHome").click(function() {
    window.location = "/";
});