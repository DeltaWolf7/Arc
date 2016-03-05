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

// Serialise form in to key:value pairs
function arcSerializeForm($form) {
    var out = {};
    var s_data = $form.serializeArray();
    //transform into simple data/value object
    for (var i = 0; i < s_data.length; i++) {
        var record = s_data[i];
        out[record.name] = record.value;
    }
    return out;
}

// Reset standard form elements
function arcResetForm($form)
{
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
}

// Fill $form with data from JSON
function arcPopulateForm($form, json)
{
    var data = arcGetJson(json);
    $.each(data, function (key, value) {
        var $ctrl = $form.find('[name=' + key + ']');
        if ($ctrl.is('select')) {
            $('option', $ctrl).each(function () {
                if (this.value == value)
                    this.selected = true;
            });
        } else if ($ctrl.is('textarea')) {
            $ctrl.val(value);
        } else {
            switch ($ctrl.attr("type")) {
                case "checkbox":
                    if (value == '1')
                        $ctrl.prop('checked', true);
                    else
                        $ctrl.prop('checked', false);
                    break;
                case "radio" :
                case "checkbox":
                    $ctrl.each(function () {
                        if ($(this).attr('value') == value) {
                            $(this).attr("checked", value);
                        }
                    });
                    break;
                case "text":
                case "hidden":
                default:
                    $ctrl.val(value);
                    break;
            }
        }
    });
}