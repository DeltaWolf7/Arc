// Details
$("#saveDetailsBtn").click(function () {
    arcAjaxRequest("arc/usersavedetails", $("#detailsForm").serialize(), null, changeComplete);
});

$(document).on('change', '.btn-file :file', function () {
    arcAjaxRequest("arc/userdetailsuploadimage", $(this)[0].files[0], null, changeComplete);
});

function changeComplete() {
    arcGetStatus();
    location.reload();
}

var addressid;

function editAddress(id) {
    addressid = id;
    arcAjaxRequest("arc/usereditaddressdetails", { id: addressid }, null, completeEdit);
    $("#editAddressModal").modal("show");
}

function completeEdit(data) {
    var jdata = arcGetJson(data);
    $("#addresslines").val(jdata.addresslines);
    $("#county").val(jdata.county);
    $("#postcode").val(jdata.postcode);
    $("#country").val(jdata.country);
    $("#isbilling").prop('checked', Boolean(Number(jdata.isbilling)));
    $("#isdelivery").prop('checked', Boolean(Number(jdata.isdelivery)));
}

function saveAddress() {
    arcAjaxRequest("arc/usersaveaddressdetails", { id: addressid, addresslines: $("#addresslines").val(),
        county: $("#county").val(), postcode: $("#postcode").val(), country: $("#country").val(),
        isbilling: $("#isbilling").prop('checked') ? 1 : 0, isdelivery: $("#isdelivery").prop('checked') ? 1 : 0}, null, changeComplete);
}

function deleteAddress(addressid) {
    arcAjaxRequest("arc/userdeleteaddressdetails", { id: addressid }, null, changeComplete);
}