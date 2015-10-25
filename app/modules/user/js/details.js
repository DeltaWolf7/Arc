// Details
    $("#saveDetailsBtn").click(function () {
        arcAjaxRequest("user/details", {firstname: $("#firstname").val(), lastname: $("#lastname").val(),
            password: $("#password").val(), password2: $("#password2").val()}, detailsComplete, null);
    });
    

// Details
function detailsComplete() {
    updateStatus("status", null);
}