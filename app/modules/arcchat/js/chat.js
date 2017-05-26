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

$("#message").keypress(function (e) {
  if (e.which == 13) {
    sendMessage();
  }
});

$("#chatSend").click(function() {
    sendMessage();
});

function sendMessage() {
    arcAjaxRequest("arcchat/sendmessage", { sessionid: sessionid, message: $("#message").val() }, null, null);
    $("#message").val("");
}

function updateMessages() {
    arcAjaxRequest("arcchat/getmessages", { sessionid: sessionid }, null, updateDisplay);
}

function updateDisplay(data) {
    var jdata = arcGetJson(data);
    $("#chatSession").html($("#chatSession").html() + jdata.html);

    $('#chatSession').animate({
        scrollTop: $('#chatSession').get(0).scrollHeight
    }, 1500);

    if (jdata.status == "Closed") {
        $("#message").prop("disabled", true);
        $("#chatSend").prop("disabled", true);
    }
}