jQuery(document).ready(function($) {
    jQuery('a[rel=tooltip]').tooltip();

    // make code pretty
    window.prettyPrint && prettyPrint();
    
    jQuery('.minimize-box').on('click', function(e){
        e.preventDefault();
        var $icon = jQuery(this).children('i');
        if($icon.hasClass('icon-chevron-down')) {
            $icon.removeClass('icon-chevron-down').addClass('icon-chevron-up');
        } else if($icon.hasClass('icon-chevron-up')) {
            $icon.removeClass('icon-chevron-up').addClass('icon-chevron-down');
        }
    });
    jQuery('.minimize-box').on('click', function(e){
        e.preventDefault();
        var $icon = jQuery(this).children('i');
        if($icon.hasClass('icon-minus')) {
            $icon.removeClass('icon-minus').addClass('icon-plus');
        } else if($icon.hasClass('icon-plus')) {
            $icon.removeClass('icon-plus').addClass('icon-minus');
        }
    });

    jQuery('.close-box').click(function() {
        jQuery(this).closest('.box').hide('slow');
    });

    jQuery('#changeSidebarPos').on('click', function(e) {
        jQuery('body').toggleClass('hide-sidebar');
    });
});

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