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