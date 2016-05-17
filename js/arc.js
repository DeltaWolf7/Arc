/*! Arc Project | Craig Longford */

// AJAX request
function arcAjaxRequest(path, data, complete, success, extended) {
    data["arcsid"] = arcsid;

    if (data["lastModified"] != null && data["name"] != null && data["size"] != null) {
        newdata = new FormData();
        newdata.append("file", data);

        // add extended properties.
        if (Array.isArray(extended)) {
            for (var item in extended) {
                if (extended.hasOwnProperty(item)) {
                    newdata.append(item, extended[item]);
                }
            }
        }

        $.ajax({
            url: window.location.protocol + "//" + window.location.host + "/" + path,
            dataType: "json",
            type: "post",
            data: newdata,
            cache: false,
            contentType: false,
            processData: false,
            complete: function (e) {
                if (typeof (complete) == "function") {
                    complete(e);
                }
            },
            success: function (e) {
                if (typeof (success) == "function") {
                    success(e);
                }
            }
        });
    } else {
        $.ajax({
            url: window.location.protocol + "//" + window.location.host + "/" + path,
            dataType: "json",
            type: "post",
            data: data,
            contentType: "application/x-www-form-urlencoded",
            processData: true,
            complete: function (e) {
                if (typeof (complete) == "function") {
                    complete(e);
                }
            },
            success: function (e) {
                if (typeof (success) == "function") {
                    success(e);
                }
            }
        });
    }
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