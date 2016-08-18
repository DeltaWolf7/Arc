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