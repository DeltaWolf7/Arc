function arcNotification(data) {
    var type = "success";
    var title = "Success";
    if (data.messages.type == "danger") {
        type = "error";
        title = "Error";
    } else {
        type = data.messages.type
    }

    $.gritter.add({
        title: title,
        text: data.messages.message,
        class_name: 'color ' + type
    });
}