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
        beforeSend: function() {
            if (typeof (arcShowLoader) == "function") {
                arcShowLoader();
            }
        },
        complete: function (e) {
            if (typeof (complete) == "function") {
                complete(e);
            }
        },
        success: function (e) {
            if (typeof (arcHideLoader) == "function") {
                arcHideLoader();
            }
            if (typeof (success) == "function") {
                success(e);
            }
        },
        error: function (xhr, desc, err) {
            if (typeof (arcShowError) == "function") {
                arcShowError(xhr, desc, err);
            } else {
                console.log(xhr.responseText + "\n" + err);
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
        data: { action: "getarcstatusmessages" },
        success: function (e) {
            var jdata = arcGetJson(e);
            if (typeof (arcNotification) == "function") {
                arcNotification(jdata);
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

// Redirect to current url without parameters
function arcRedirect() {
    window.location = window.location.href.split('?')[0];
}

// Reload current page
function arcRefresh() {
    location.reload();
}

// Return url with number of parts removed. example http://mydomain.com/test/1/2 -> http://mydomain.com/test/1
function arcGetPath(noPartsToRemove = 0) {
    var pathArray = window.location.pathname.split('/');
    var newPathname = window.location.protocol + "//" + window.location.host;
    for (i = 0; i < pathArray.length - noPartsToRemove; i++) {
        newPathname += pathArray[i] + "/";
    }
    return newPathname.substring(0, newPathname.length - 1);;
}