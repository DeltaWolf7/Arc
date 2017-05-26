function success(data) {
    var jdata = arcGetJson(data);
    if (jdata.redirect) {
        window.location = jdata.redirect;
    }
}

// Register
$("#registerBtn").click(function() {
    arcAjaxRequest("arcchat/guestregister", {
        firstname: $("#firstname").val(),
        lastname: $("#lastname").val(),
        emailr: $("#emailr").val()
    }, arcGetStatus, success);
});