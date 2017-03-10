/*! Arc Project | Craig Longford */

// AJAX request
function arcAjaxRequest(path, data, complete, success, extended) {
    data["arcsid"] = arcsid;

    if (data["lastModified"] != null && data["name"] != null && data["size"] != null) {
        newdata = new FormData();
        newdata.append("file", data);

        // add extended properties.
        for (var item in extended) {
            if (extended.hasOwnProperty(item)) {
                newdata.append(item, extended[item]);
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
            },
            error: function (xhr, desc, err) {
                console.log(xhr.responseText + "\n" + err);
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
            },
            error: function (xhr, desc, err) {
                console.log(xhr.responseText + "\n" + err);
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

function arcCleanSummernote(code) {
    //http://stackoverflow.com/questions/25119253/using-javascript-or-jquery-to-clean-wysiwyg-editors-html-output
    var newCode = $('<div></div>').append(code)
            .find('iframe')
            .wrap('<div class="flexVideo"/>')
            .end()
            .find('img')
            .removeAttr('style')
            .wrap('<div class="flexPhoto"/>')
            .end()
            .find('span')
            .filter("[style*='underline']")
            .removeAttr('style')
            .addClass('underline')
            .end()
            .filter("[style*='bold']")
            .wrapInner('<b></b>')
            .children()
            .unwrap()
            .end()
            .end()
            .filter("[style*='italic']")
            .wrapInner('<i></i>')
            .children()
            .unwrap()
            .end()
            .end()
            .end()
            .html();
    return newCode;
}

var kkeys = [], konami = "38,38,40,40,37,39,37,39,66,65";
$(document).keydown(function (e) {
    kkeys.push(e.keyCode);
    if (kkeys.toString().indexOf(konami) >= 0) {
        $(document).unbind('keydown', arguments.callee);
        alert("Nice try ;-p");
    }
});