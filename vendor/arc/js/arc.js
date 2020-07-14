/*! Arc Project | Craig Longford */

// AJAX request
function arcAjaxRequest(path, data, complete, success, extended) {
    // session data
    data["arcsid"] = arcsid;

    // standard parameters for Ajax request
    contentType = "application/x-www-form-urlencoded";
    processData = true;

    // do we have file(s)
    if (data["lastModified"] != null && data["name"] != null && data["size"] != null) {
        newdata = new FormData();
        newdata.append("file", data);

        // add extended properties.
        for (var item in extended) {
            if (extended.hasOwnProperty(item)) {
                newdata.append(item, extended[item]);
            }
        }

        // replace data
        data = newdata;
        contentType = false;
        processData = false;
    }

    // do Ajax request
    $.ajax({
        url: window.location.protocol + "//" + window.location.host + "/" + path,
        dataType: "json",
        type: "post",
        data: data,
        cache: false,
        contentType: contentType,
        processData: processData,
        complete: function (e) {
            if (typeof (complete) == "function") {
                complete(e);
            }
        },
        success: function (e) {
            if (typeof (success) == "function") {
                success(e);
            }
        },
        error: function (xhr, desc, err) {
            console.log(xhr.responseText + "\n" + err);
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
        data: { action: "getarcstatusmessages" },
        success: function (e) {
            var jdata = arcGetJson(e);
            if (typeof (arcNotification) == "function") {
                arcNotification(jdata)
            } else {
                alert("arcNotification has not been defined in theme. See console");
                console.log("You must define a function named 'arcNotification' in your theme.");
                console.log(jdata);
            }
        },
        error: function (xhr, desc, err) {
            console.log(xhr.responseText + "\n" + err);
        }
    })
}

// Convert JSON in to Javascript object
function arcGetJson(data) {
    return jQuery.parseJSON(JSON.stringify(data));
}