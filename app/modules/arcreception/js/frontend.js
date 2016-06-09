$(document).ready(function () {
    startTime();
});

function startTime() {
    $(".time").html(moment().format("HH:mm:ss"));
    $(".date").html(moment().format("dddd, Do MMMM"));
    setTimeout(startTime, 500);
}