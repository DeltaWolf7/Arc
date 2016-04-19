/*! Arc Project | Craig Longford */

// AJAX request
function arcAjaxRequest(path, data, complete, success, fileupload) {
    data["arcsid"] = arcsid;
    var process = true;
    if (fileupload == null) {
        //fileupload = "application/x-www-form-urlencoded";
    } else {
        //fileupload = "multipart/form-data";
        process = false;
    }
     
    $.ajax({
        url: window.location.protocol + "//" + window.location.host + "/" + path,
        dataType: "json",
        type: "post",
        contentType: false,
        processData: process,
        data: data,
        complete: function (e) {
            if (typeof (complete) == "function") {
                complete(e)
            }
        },
        success: function (e) {
            if (typeof (success) == "function") {
                success(e)
            }
        }
    });
}

// Get status message
function arcGetStatus() {
    $.ajax({
        url: "/",
        dataType: "json",
        type: "post",
        cache: false,
        contentType: "application/x-www-form-urlencoded",
        data: {action: "getarcstatusmessages"},
        success: function (e) {
            var jdata = arcGetJson(e);
            if (typeof (arcNotification) == "function") {
                arcNotification(jdata)
            } else {
                alert("arcNotification has not been defined in theme. See console");
                console.log("You must define a function named 'arcNotification' in your theme.");
                console.log(jdata);
            }
        }})
}

// Convert JSON in to Javascript object
function arcGetJson(data) {
    return jQuery.parseJSON(JSON.stringify(data));
}