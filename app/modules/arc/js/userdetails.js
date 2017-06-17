// Details
    $("#saveDetailsBtn").click(function () {
        arcAjaxRequest("arc/usersavedetails", $("#detailsForm").serialize(), detailsComplete, null);
    });
    

// Details
function detailsComplete() {
    arcGetStatus();
}


$(document).on('change', '.btn-file :file', function () {
    arcAjaxRequest("arc/userdetailsuploadimage", $(this)[0].files[0], changeComplete, null);
});

function changeComplete() {
    arcGetStatus();
    location.reload();
}