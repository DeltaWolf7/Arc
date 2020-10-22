function arcNotification(data) {
    switch (data.messages.type) {
        case "danger":
            title = "Error";
            type = "error"
            break;
        case "primary":
            title = "Information";
            type = "info"
            break;
        case "warning":
            title = "Warning";
            type = "warning";
            break;
        case "wrong":
            title = "Incorrect";
            type = "error"
            break;
        case "right":
            title = "Correct";
            type = "success";
            break;
        default:
            title = "Success";
            type = "success";
            break;
    }

    swal(
        title,
        data.messages.message,
        type
    )
}