///////////// CRM ADDRESS /////////////

/// USES CONTROLLERS FROM ADDONS -> ARC -> USER /// 

// crm address new
$("#crmnewaddress").submit(function(e) {
    e.preventDefault();
    arcAjaxRequest("addons/arc/users/crmeditaddress", $(this).serialize(), showEditAddressModal);
});

// crm address edit
function editCRMAddress(addressid, userid) {
    arcAjaxRequest("addons/arc/users/crmeditaddress", { addressid: addressid, addressuserid: userid }, null, showEditAddressModal);
}

// crm address edit complete
function showEditAddressModal(data) {
    var jdata = arcGetJson(data);
    $("#addresslines").val(jdata.addresslines);
    $("#county").val(jdata.county);
    $("#postcode").val(jdata.postcode);
    $("#country").val(jdata.country);
    $("#isbilling").prop('checked', Boolean(Number(jdata.isbilling)));
    $("#isdelivery").prop('checked', Boolean(Number(jdata.isdelivery)));
    $("#addressid").val(jdata.id);
    $("#editAddressModal").modal("show");
}

// crm address save
$("#crmeditaddressform").submit(function(e) {
    e.preventDefault();
    arcAjaxRequest("addons/arc/users/crmsaveaddress", $(this).serialize(), null, crmEditAddressSaved);
});

// crm address save complete
function crmEditAddressSaved(data) {
    var jdata = arcGetJson(data);
    if (!data.error) {
        $("#editAddressModal").modal("hide");
        location.reload();
    }
    arcGetStatus();
}

// crm address remove
function crmRemoveAddress(addressid) {
    arcAjaxRequest("addons/arc/users/crmremoveaddress", { addressid: addressid }, location.reload());
}

///////////// CRM USER ////////////

// crm user save
$("#crmuserform").submit(function(e) { 
    e.preventDefault();
    arcAjaxRequest("addons/arc/userdetails/crmusersave", $(this).serialize(), null, arcGetStatus);
});