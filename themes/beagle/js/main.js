function arcNotification(data) {
    switch (data.messages.type) {
        case "danger":
            title = "Error";
            break;
        case "primary":
            title = "Information";
            break;
        case "warning":
            title = "Warning";
            break;
        default:
            title = "Success";
            break;
    }

    $.gritter.add({
        title: title,
        text: data.messages.message,
        class_name: 'color ' + data.messages.type
    });
}

$(document).ready(function () {
    //initialize the javascript
    App.init();
})

var App = (function () {
    'use strict';

    //Basic Config
    var config = {
        leftSidebarSlideSpeed: 200,
        leftSidebarToggleSpeed: 300,
        openRightSidebarClass: 'open-right-sidebar',
        removeLeftSidebarClass: 'be-nosidebar-left',
        transitionClass: 'be-animate',
        openSidebarDelay: 400
    };

    var body = $("body");
    var leftSidebar = $(".be-left-sidebar");
    var rightSidebar = $(".be-right-sidebar");
    var openSidebar = false;

    //Core private functions
    function leftSidebarInit() {

        var firstAnchor = $(".sidebar-elements > li > a", leftSidebar);
        var lsToggle = $(".left-sidebar-toggle", leftSidebar);

        /*Open sub-menu functionality*/
        firstAnchor.on("click", function (e) {

            var $el = $(this), $open, $speed = config.leftSidebarSlideSpeed;
            var $li = $el.parent();
            var $subMenu = $el.next();

            $open = $li.siblings(".open");

            if ($open) {
                $open.find('> ul:visible').slideUp({duration: $speed, complete: function () {
                        $open.toggleClass('open');
                        $(this).removeAttr('style');
                    }});
            }

            if ($li.hasClass('open')) {
                $subMenu.slideUp({duration: $speed, complete: function () {
                        $li.toggleClass('open');
                        $(this).removeAttr('style');
                    }});
            } else {
                $subMenu.slideDown({duration: $speed, complete: function () {
                        $li.toggleClass('open');
                        $(this).removeAttr('style');
                    }});
            }

            if ($el.next().is('ul')) {
                e.preventDefault();
            }

        });

        /*Calculate sidebar tree active & open classes*/
        $("li.active", leftSidebar).parents(".parent").addClass("active open");


        /*Toggle sidebar on small devices*/
        lsToggle.on('click', function (e) {
            var spacer = $(this).next('.left-sidebar-spacer'), toggleBtn = $(this);
            toggleBtn.toggleClass('open');
            spacer.slideToggle({duration: config.leftSidebarToggleSpeed});
        });
    }

    function rightSidebarInit() {

        function oSidebar() {
            body.addClass(config.openRightSidebarClass + " " + config.transitionClass);
        }

        function cSidebar() {
            body.removeClass(config.openRightSidebarClass).addClass(config.transitionClass);
            sidebarDelay();
        }

        if (rightSidebar.length > 0) {
            /*Open-Sidebar when click on topbar button*/
            $('.be-toggle-right-sidebar').on("click", function (e) {
                if (openSidebar && body.hasClass(config.openRightSidebarClass)) {
                    cSidebar();
                } else if (!openSidebar) {
                    oSidebar();
                }

                e.preventDefault();
            });

            /*Close sidebar on click outside*/
            $(document).on("mousedown touchstart", function (e) {
                if (!$(e.target).closest(rightSidebar).length && body.hasClass(config.openRightSidebarClass)) {
                    cSidebar();
                }
            });
        }
    }

    function sidebarDelay() {
        openSidebar = true;
        setTimeout(function () {
            openSidebar = false;
        }, config.openSidebarDelay);
    }

    return {
        //Init function
        init: function () {

            /*Left Sidebar*/
            leftSidebarInit();

            /*Right Sidebar*/
            rightSidebarInit();

            //Prevent Connections Dropdown closes on click
            $(".be-connections").on("click", function (e) {
                e.stopPropagation();
            });

            /*Bootstrap modal scroll top fix*/
            $('.modal').on('show.bs.modal', function () {
                $("html").addClass('be-modal-open');
            });

            $('.modal').on('hidden.bs.modal', function () {
                $("html").removeClass('be-modal-open');
            });
        }
    };
})();