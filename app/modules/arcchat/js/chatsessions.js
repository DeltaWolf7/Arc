var sessionid = 0;

$(document).ready(function() {
    setInterval(function() { updateMessages(); }, 2000); // 2 seconds
});

function updateMessages() {
    if (sessionid != 0) {
        arcAjaxRequest("arcchat/getmessages", { sessionid: sessionid }, null, updateDisplay);
    }
}

function updateDisplay(data) {
    var jdata = arcGetJson(data);
    $("#chatSession").html($("#chatSession").html() + jdata.html);
    $('#chatSession').animate({
        scrollTop: $('#chatSession').get(0).scrollHeight
    }, 1500);
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

function joinChat(id) {
    $("#chatDialog").modal("show");
    $("#chatSession").html("");
    sessionid = id;
}

$("#closeChat").click(function() {
    arcAjaxRequest("arcchat/closesession", {}, null, null);
});

function endChat(id) {
    arcAjaxRequest("arcchat/endchat", { sessionid: id }, arcGetStatus, null);
    location.reload();
}