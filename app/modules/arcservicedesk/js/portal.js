$("#ticket").submit(function( event ) {
    event.preventDefault();
    arcAjaxRequest("arcservicedesk/createticket", {
        summary: $("#summary").val(),
        description: $("#description").val()
    }, arcGetStatus);
    $(":submit").attr("disabled", true);
});