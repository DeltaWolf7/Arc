$("#commentForm").submit(function( event ) {
    event.preventDefault();
    arcAjaxRequest("arcservicedesk/addcomment", {
        comment: $("#commentTXT").val(),
        ticketid: $("#ticketid").val()
    }, arcGetStatus, success);
    $("#commentTXT").val("");
});

function success(data) {
    var jdata = arcGetJson(data);
    if (jdata.success == "true") {
        arcReload();
    }
}

$("#assignedForm").submit(function( event ) {
    event.preventDefault();
    arcAjaxRequest("arcservicedesk/changeassigned", {
        assigned: $("#assigned").val(),
        ticketid: $("#ticketid").val()
    }, arcGetStatus, arcReload);
});

$("#statusForm").submit(function( event ) {
    event.preventDefault();
    arcAjaxRequest("arcservicedesk/changestatus", {
        status: $("#status").val(),
        ticketid: $("#ticketid").val()
    }, arcGetStatus, arcReload);
});