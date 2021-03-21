function saveUpdate(oid) {
    arcAjaxRequest("arccommerce/saveOrderUpdate", {
        oid: oid,
        status: $("#status").val(),
        tracking: $("#tracking").val(),
        dropship: $("#dropship").val()
    }, arcGetStatus);
}