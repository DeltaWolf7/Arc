function arcNotification(data) {
    $.notify({
        // options
        message: data.messages.message
    }, {
        // settings
        type: data.messages.type
    });
}