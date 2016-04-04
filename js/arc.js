/*! Arc Project | Craig Longford */

// AJAX request
function arcAjaxRequest(x, c, d, a) {
    c["arcsid"] = arcsid;
    $.ajax({
        url: window.location.protocol + "//" + window.location.host + "/" + x,
        dataType: "json",
        type: "post",
        contentType: "application/x-www-form-urlencoded",
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
    })
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

//
function arcUploadImage(file, $editor) {
    data = new FormData();
    data.append("file", file);
    $.ajax({
        data: data,
        type: "POST",
        url: window.location.protocol + "//" + window.location.host + "/",
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            arcNotification({messages: {type: "info", message: "Please wait while the image is uploaded"}});
            arcGetStatus();
        },
        success: function (url) {
            if (url != "") {
                $editor.summernote("insertImage", url);
            } else {
                arcGetStatus();
            }
        }
    });
}