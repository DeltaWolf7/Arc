// Details
    $("#saveDetailsBtn").click(function () {
        arcAjaxRequest("user/details", $("#detailsForm").serialize(), detailsComplete, null);
    });
    

// Details
function detailsComplete() {
    arcGetStatus();
}


$(document).on('change', '.btn-file :file', function () {
    arcAjaxRequest("user/uploadimage", $(this)[0].files[0], changeComplete, null);
});

function changeComplete() {
    arcGetStatus();
    location.reload();
}