var sessionid = 0;

$(document).ready(function() {
    arcAjaxRequest("arcchat/startsession", {}, null, sessionStarted);
    setInterval(function() { updateMessages(); }, 2000); // 2 seconds
});

function sessionStarted(data) {
    var jdata = arcGetJson(data);
    $("#chatSession").html($("#chatSession").html() +
        "<div class=\"card-subtitle\">Session #" + jdata.session +
        ", " + jdata.event + "</div>");
    sessionid = jdata.session;
}

$("#chatSend").click(function() {
    arcAjaxRequest("arcchat/sendmessage", { sessionid: sessionid, message: $("#message").val() }, null, null);
    $("#message").val("");
});

function updateMessages() {
    arcAjaxRequest("arcchat/getmessages", { sessionid: sessionid }, null, updateDisplay);
}

function updateDisplay(data) {
    var jdata = arcGetJson(data);
    $("#chatSession").html($("#chatSession").html() + jdata.html);
    console.log(jdata.status);
    if (jdata.status == "Closed") {
        $("#message").prop("disabled", true);
        $("#chatSend").prop("disabled", true);
    }
}