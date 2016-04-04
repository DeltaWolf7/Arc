// Details
    $("#saveDetailsBtn").click(function () {
        arcAjaxRequest("user/details", $("#detailsForm").serialize(), detailsComplete, null);
    });
    

// Details
function detailsComplete() {
    arcGetStatus();
}