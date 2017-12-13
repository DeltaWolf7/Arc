function arcNotification(data) {
    $.notify({      
        message: data.messages.message
    },{
        type: data.messages.type
    });
}