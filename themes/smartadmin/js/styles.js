function arcNotification(data) {
    var title = "";
    var colour = "";
    var icon = "";

    switch (data.messages.type) {
        case "warning":
            title = "Warning";
            colour = "#C79121";
            icon = "shield";
            break;
        case "danger":
            title = "Error";
            colour = "#C46A69";
            icon = "warning";
            break;
        case "success":
            title = "Success";
            colour = "#739E73";
            icon = "check";
            break;
        case "info":
            title = "Information";
            colour = "#3276B1";
            icon = "bell";
            break;
            
    }

    $.bigBox({
        title: title,
        content: data.messages.message,
        color: colour,
        //timeout: 6000,
        icon: "fa fa-" + icon + " shake animated",
        timeout: 6000
    });

    e.preventDefault();
}
