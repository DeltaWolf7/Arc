$(document).ready(function () {
    getState("splash");
});

function getState(state) {
    if (state == "splash") {
        arcAjaxRequest("arcreception/getsplash", {}, null, updateScreen);
    } else if (state == "signin") {
        arcAjaxRequest("arcreception/getsignin", {}, null, updateScreen);
    }
}

function updateScreen(data) {
    var jdata = arcGetJson(data);
    $("#data").html(jdata.html);
    if (jdata.state == "splash") {
        startTime();
    }
}

function startTime() {
    $(".time").html(moment().format("HH:mm:ss"));
    $(".date").html(moment().format("dddd, Do MMMM"));
    setTimeout(startTime, 500);
}