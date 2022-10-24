///////////// CRM USER ////////////

// crm user save
$("#crmuserform").submit(function(e) { 
    e.preventDefault();
    arcAjaxRequest("addons/arc/users/crmusersave", $(this).serialize(), null, arcGetStatus);
});

//////////// CRM CONTACT //////////

// crm contact new
$("#crmnewcontact").submit(function(e) {
    e.preventDefault();
    arcAjaxRequest("addons/arc/users/crmeditcontact", $(this).serialize(), null,  showEditContactModal);
});

// crm contact edit
function editCRMContact(contactid, userid) {
    arcAjaxRequest("addons/arc/users/crmeditcontact", { contactid: contactid, userid: userid }, null, showEditContactModal);
}

// crm contact new/edit modal populate
function showEditContactModal(data) { 
    var jdata = arcGetJson(data);
    $("#contactname").val(jdata.name);
    $("#contacttitle").val(jdata.title);
    $("#contactemail").val(jdata.email);
    $("#contactphone").val(jdata.phone);
    $("#contactid").val(jdata.id);
    $("#editContactModal").modal("show");
}

// crm contact save
$("#crmeditcontactform").submit(function(e) {
    e.preventDefault();
    arcAjaxRequest("addons/arc/users/crmsavecontact", $(this).serialize(), null, crmEditContactSaved);
});

// crm contact save complete
function crmEditContactSaved(data) {
    if (!data.error) {
        $("#editContactModal").modal("hide");
        location.reload();
    }
    arcGetStatus();
}

// crm contact remove
function crmRemoveContact(contactid) {
    arcAjaxRequest("addons/arc/users/crmremovecontact", { contactid: contactid }, location.reload());
}

///////////// CRM ADDRESS /////////////

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