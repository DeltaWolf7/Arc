function arcNotification(data) {
    var type = "success";
    var title = "Success";
    if (data.messages.type == "danger") {
        type = "error";
        title = "Error";
    } else {
        type = data.messages.type
    }
    swal(title, data.messages.message, type);
}


