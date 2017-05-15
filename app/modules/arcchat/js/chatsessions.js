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
}

$("#chatSend").click(function() {
    arcAjaxRequest("arcchat/sendmessage", { sessionid: sessionid, message: $("#message").val() }, null, null);
    $("#message").val("");
});

function joinChat(id) {
    $("#chatDialog").modal("show");
    $("#chatSession").html("");
    sessionid = id;
}

$("#closeChat").click(function() {
    arcAjaxRequest("arcchat/closesession", {}, null, null);
    sessionid = 0;
});

function endChat(id) {
    arcAjaxRequest("arcchat/endchat", { sessionid: id }, arcGetStatus, null);
}