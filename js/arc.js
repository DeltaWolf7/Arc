/*! Arc Project | Craig Longford */

// AJAX request
function arcAjaxRequest(x, c, d, a, fileupload) {
    c["arcsid"] = arcsid;
    var process = true;
    if (fileupload == null) {
        fileupload = "application/x-www-form-urlencoded";
    } else {
        fileupload = "multipart/form-data";
        process = false;
    }
    
    console.log(fileupload + " | " + process);
    
    $.ajax({
        url: window.location.protocol + "//" + window.location.host + "/" + x,
        dataType: "json",
        type: "post",
        contentType: fileupload,
        processData: process,
        data: c,
        complete: function (e) {
            if (typeof (d) == "function") {
                d(e)
            }
        },
        success: function (e) {
            if (typeof (a) == "function") {
                a(e)
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