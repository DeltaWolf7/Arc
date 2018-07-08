$(window).on('load', function () {
    $('#status').fadeOut();
    $('#preloader').delay(350).fadeOut('slow');
    $('body').delay(350).css({
        'overflow': 'visible'
    });


    $('.slimscroll-noti').slimScroll({
        height: '230px',
        position: 'right',
        size: "5px",
        color: '#98a6ad',
        wheelStep: 10
    });

    $('.navbar-toggle').on('click', function (event) {
        $(this).toggleClass('open');
        $('#navigation').slideToggle(400);
    });

    $('.navigation-menu>li').slice(-1).addClass('last-elements');

    $('.navigation-menu li.has-submenu a[href="#"]').on('click', function (e) {
        if ($(window).width() < 992) {
            e.preventDefault();
            $(this).parent('li').toggleClass('open').find('.submenu:first').toggleClass('open');
        }
    });
});

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