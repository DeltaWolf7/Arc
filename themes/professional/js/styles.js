	$.root_ = $('body');	
	var root = this,	
	throttle_delay = 350,
	menu_speed = 500,	
	menu_accordion = true,	
	ignore_key_elms = ["#header, #left-panel, #right-panel, #main, div.page-footer, #shortcut, #divSmallBoxes, #divMiniIcons, #divbigBoxes, #voiceModal, script, .ui-chatbox"];

function pageSetUp() {
    "desktop" === thisDevice ? ($("[rel=tooltip], [data-rel=tooltip]").tooltip(), $("[rel=popover], [data-rel=popover]").popover(), $("[rel=popover-hover], [data-rel=popover-hover]").popover({
        "trigger": "hover"
    })) : ($("[rel=popover], [data-rel=popover]").popover(), $("[rel=popover-hover], [data-rel=popover-hover]").popover({
        "trigger": "hover"
    }))
}


$.intervalArr = [];
var calc_navbar_height = function () {
    var a = null;
    return $("#header").length && (a = $("#header").height()), null === a && (a = $('<div id="header"></div>').height()), null === a ? 49 : a
},
        navbar_height = calc_navbar_height,
        shortcut_dropdown = $("#shortcut"),
        bread_crumb = $("#ribbon ol.breadcrumb"),
        topmenu = !1,
        thisDevice = null,
        ismobile = /iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()),
        jsArray = {},
        initApp = function (a) {
            return a.addDeviceType = function () {
                return ismobile ? ($.root_.addClass("mobile-detected"), thisDevice = "mobile", fastClick ? ($.root_.addClass("needsclick"), FastClick.attach(document.body), !1) : void 0) : ($.root_.addClass("desktop-detected"), thisDevice = "desktop", !1)
            }, a.menuPos = function () {
                ($.root_.hasClass("menu-on-top") || "top" == localStorage.getItem("sm-setmenu")) && (topmenu = !0, $.root_.addClass("menu-on-top"))
            }, a.SmartActions = function () {
                var a = {
                    "userLogout": function (a) {
                        function b() {
                            window.location = a.attr("href")
                        }
                        $.SmartMessageBox({
                            "title": "<i class='fa fa-sign-out txt-color-orangeDark'></i> Logout <span class='txt-color-orangeDark'><strong>" + $("#show-shortcut").text() + "</strong></span> ?",
                            "content": a.data("logout-msg") || "You can improve your security further after logging out by closing this opened browser",
                            "buttons": "[No][Yes]"
                        }, function (a) {
                            "Yes" == a && ($.root_.addClass("animated fadeOutUp"), setTimeout(b, 1e3))
                        })
                    },
                    "resetWidgets": function (a) {
                        $.SmartMessageBox({
                            "title": "<i class='fa fa-refresh' style='color:green'></i> Clear Local Storage",
                            "content": a.data("reset-msg") || "Would you like to RESET all your saved widgets and clear LocalStorage?1",
                            "buttons": "[No][Yes]"
                        }, function (a) {
                            "Yes" == a && localStorage && (localStorage.clear(), location.reload())
                        })
                    },
                    "launchFullscreen": function (a) {
                        $.root_.hasClass("full-screen") ? ($.root_.removeClass("full-screen"), document.exitFullscreen ? document.exitFullscreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitExitFullscreen && document.webkitExitFullscreen()) : ($.root_.addClass("full-screen"), a.requestFullscreen ? a.requestFullscreen() : a.mozRequestFullScreen ? a.mozRequestFullScreen() : a.webkitRequestFullscreen ? a.webkitRequestFullscreen() : a.msRequestFullscreen && a.msRequestFullscreen())
                    },
                    "minifyMenu": function (a) {
                        $.root_.hasClass("menu-on-top") || ($.root_.toggleClass("minified"), $.root_.removeClass("hidden-menu"), $("html").removeClass("hidden-menu-mobile-lock"), a.effect("highlight", {}, 500))
                    },
                    "toggleMenu": function () {
                        $.root_.hasClass("menu-on-top") ? $.root_.hasClass("menu-on-top") && $(window).width() < 979 && ($("html").toggleClass("hidden-menu-mobile-lock"), $.root_.toggleClass("hidden-menu"), $.root_.removeClass("minified")) : ($("html").toggleClass("hidden-menu-mobile-lock"), $.root_.toggleClass("hidden-menu"), $.root_.removeClass("minified"))
                    },
                    "toggleShortcut": function () {
                        function a() {
                            shortcut_dropdown.animate({
                                "height": "hide"
                            }, 300, "easeOutCirc"), $.root_.removeClass("shortcut-on")
                        }

                        function b() {
                            shortcut_dropdown.animate({
                                "height": "show"
                            }, 200, "easeOutCirc"), $.root_.addClass("shortcut-on")
                        }
                        shortcut_dropdown.is(":visible") ? a() : b(), shortcut_dropdown.find("a").click(function (b) {
                            b.preventDefault(), window.location = $(this).attr("href"), setTimeout(a, 300)
                        }), $(document).mouseup(function (b) {
                            shortcut_dropdown.is(b.target) || 0 !== shortcut_dropdown.has(b.target).length || a()
                        })
                    }
                };
                $.root_.on("click", '[data-action="userLogout"]', function (b) {
                    var c = $(this);
                    a.userLogout(c), b.preventDefault(), c = null
                }), $.root_.on("click", '[data-action="resetWidgets"]', function (b) {
                    var c = $(this);
                    a.resetWidgets(c), b.preventDefault(), c = null
                }), $.root_.on("click", '[data-action="launchFullscreen"]', function (b) {
                    a.launchFullscreen(document.documentElement), b.preventDefault()
                }), $.root_.on("click", '[data-action="minifyMenu"]', function (b) {
                    var c = $(this);
                    a.minifyMenu(c), b.preventDefault(), c = null
                }), $.root_.on("click", '[data-action="toggleMenu"]', function (b) {
                    a.toggleMenu(), b.preventDefault()
                }), $.root_.on("click", '[data-action="toggleShortcut"]', function (b) {
                    a.toggleShortcut(), b.preventDefault()
                })
            }, a.leftNav = function () {
                topmenu || $("nav ul").jarvismenu({
                    "accordion": menu_accordion || !0,
                    "speed": menu_speed || !0,
                    "closedSign": '<em class="fa fa-plus-square-o"></em>',
                    "openedSign": '<em class="fa fa-minus-square-o"></em>'
                })
            }, a.domReadyMisc = function () {
                $("[rel=tooltip]").length && $("[rel=tooltip]").tooltip(), $("#search-mobile").click(function () {
                    $.root_.addClass("search-mobile")
                }), $("#cancel-search-js").click(function () {
                    $.root_.removeClass("search-mobile")
                }), $("#activity").click(function (a) {
                    var b = $(this);
                    b.find(".badge").hasClass("bg-color-red") && (b.find(".badge").removeClassPrefix("bg-color-"), b.find(".badge").text("0")), b.next(".ajax-dropdown").is(":visible") ? (b.next(".ajax-dropdown").fadeOut(150), b.removeClass("active")) : (b.next(".ajax-dropdown").fadeIn(150), b.addClass("active"));
                    var c = b.next(".ajax-dropdown").find(".btn-group > .active > input").attr("id");
                    b = null, c = null, a.preventDefault()
                }), $('input[name="activity"]').change(function () {
                    var a = $(this);
                    url = a.attr("id"), container = $(".ajax-notifications"), loadURL(url, container), a = null
                }), $(document).mouseup(function (a) {
                    $(".ajax-dropdown").is(a.target) || 0 !== $(".ajax-dropdown").has(a.target).length || ($(".ajax-dropdown").fadeOut(150), $(".ajax-dropdown").prev().removeClass("active"))
                }), $("button[data-btn-loading]").on("click", function () {
                    var a = $(this);
                    a.button("loading"), setTimeout(function () {
                        a.button("reset")
                    }, 3e3)
                }), $this = $("#activity > .badge"), parseInt($this.text()) > 0 && ($this.addClass("bg-color-red bounceIn animated"), $this = null)
            }, a.mobileCheckActivation = function () {
                $(window).width() < 979 ? ($.root_.addClass("mobile-view-activated"), $.root_.removeClass("minified")) : $.root_.hasClass("mobile-view-activated") && $.root_.removeClass("mobile-view-activated"), debugState && console.log("mobileCheckActivation")
            }, a
        }({});
initApp.addDeviceType(), initApp.menuPos(), jQuery(document).ready(function () {
    initApp.SmartActions(), initApp.leftNav(), initApp.domReadyMisc()
}),
        function (a, b, c) {
            function d() {
                e = b[h](function () {
                    f.each(function () {
                        var b, c, d = a(this),
                                e = a.data(this, j);
                        try {
                            b = d.width()
                        } catch (f) {
                            b = d.width
                        }
                        try {
                            c = d.height()
                        } catch (f) {
                            c = d.height
                        }
                        (b !== e.w || c !== e.h) && d.trigger(i, [e.w = b, e.h = c])
                    }), d()
                }, g[k])
            }
            var e, f = a([]),
                    g = a.resize = a.extend(a.resize, {}),
                    h = "setTimeout",
                    i = "resize",
                    j = i + "-special-event",
                    k = "delay",
                    l = "throttleWindow";
            g[k] = throttle_delay, g[l] = !0, a.event.special[i] = {
                "setup": function () {
                    if (!g[l] && this[h])
                        return !1;
                    var b = a(this);
                    f = f.add(b);
                    try {
                        a.data(this, j, {
                            "w": b.width(),
                            "h": b.height()
                        })
                    } catch (c) {
                        a.data(this, j, {
                            "w": b.width,
                            "h": b.height
                        })
                    }
                    1 === f.length && d()
                },
                "teardown": function () {
                    if (!g[l] && this[h])
                        return !1;
                    var b = a(this);
                    f = f.not(b), b.removeData(j), f.length || clearTimeout(e)
                },
                "add": function (b) {
                    function d(b, d, f) {
                        var g = a(this),
                                h = a.data(this, j);
                        h.w = d !== c ? d : g.width(), h.h = f !== c ? f : g.height(), e.apply(this, arguments)
                    }
                    if (!g[l] && this[h])
                        return !1;
                    var e;
                    return a.isFunction(b) ? (e = b, d) : (e = b.handler, void(b.handler = d))
                }
            }
        }(jQuery, this), $("#main").resize(function () {
    initApp.mobileCheckActivation()
});
var ie = function () {
    for (var a, b = 3, c = document.createElement("div"), d = c.getElementsByTagName("i"); c.innerHTML = "<!--[if gt IE " + ++b + "]><i></i><![endif]-->", d[0]; )
        ;
    return b > 4 ? b : a
}();
if ($.fn.extend({
    "jarvismenu": function (a) {
        var b = {
            "accordion": "true",
            "speed": 200,
            "closedSign": "[+]",
            "openedSign": "[-]"
        },
        c = $.extend(b, a),
                d = $(this);
        d.find("li").each(function () {
            0 !== $(this).find("ul").length && ($(this).find("a:first").append("<b class='collapse-sign'>" + c.closedSign + "</b>"), "#" == $(this).find("a:first").attr("href") && $(this).find("a:first").click(function () {
                return !1
            }))
        }), d.find("li.active").each(function () {
            $(this).parents("ul").slideDown(c.speed), $(this).parents("ul").parent("li").find("b:first").html(c.openedSign), $(this).parents("ul").parent("li").addClass("open")
        }), d.find("li a").click(function () {
            0 !== $(this).parent().find("ul").length && (c.accordion && ($(this).parent().find("ul").is(":visible") || (parents = $(this).parent().parents("ul"), visible = d.find("ul:visible"), visible.each(function (a) {
                var b = !0;
                parents.each(function (c) {
                    return parents[c] == visible[a] ? (b = !1, !1) : void 0
                }), b && $(this).parent().find("ul") != visible[a] && $(visible[a]).slideUp(c.speed, function () {
                    $(this).parent("li").find("b:first").html(c.closedSign), $(this).parent("li").removeClass("open")
                })
            }))), $(this).parent().find("ul:first").is(":visible") && !$(this).parent().find("ul:first").hasClass("active") ? $(this).parent().find("ul:first").slideUp(c.speed, function () {
                $(this).parent("li").removeClass("open"), $(this).parent("li").find("b:first").delay(c.speed).html(c.closedSign)
            }) : $(this).parent().find("ul:first").slideDown(c.speed, function () {
                $(this).parent("li").addClass("open"), $(this).parent("li").find("b:first").delay(c.speed).html(c.openedSign)
            }))
        })
    }
}), jQuery.fn.doesExist = function () {
    return jQuery(this).length > 0
}, $.navAsAjax || $(".google_maps")) {
    var gMapsLoaded = !1;
    window.gMapsCallback = function () {
        gMapsLoaded = !0, $(window).trigger("gMapsLoaded")
    }, window.loadGoogleMaps = function () {
        if (gMapsLoaded)
            return window.gMapsCallback();
        var a = document.createElement("script");
        a.setAttribute("type", "text/javascript"), a.setAttribute("src", "http://maps.google.com/maps/api/js?sensor=false&callback=gMapsCallback"), (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(a)
    }
}
$.navAsAjax && ($("nav").length && checkURL(), $(document).on("click", 'nav a[href!="#"]', function (a) {
    a.preventDefault();
    var b = $(a.currentTarget);
    b.parent().hasClass("active") || b.attr("target") || ($.root_.hasClass("mobile-view-activated") ? ($.root_.removeClass("hidden-menu"), $("html").removeClass("hidden-menu-mobile-lock"), window.setTimeout(function () {
        window.location.search ? window.location.href = window.location.href.replace(window.location.search, "").replace(window.location.hash, "") + "#" + b.attr("href") : window.location.hash = b.attr("href")
    }, 150)) : window.location.search ? window.location.href = window.location.href.replace(window.location.search, "").replace(window.location.hash, "") + "#" + b.attr("href") : window.location.hash = b.attr("href"))
}), $(document).on("click", 'nav a[target="_blank"]', function (a) {
    a.preventDefault();
    var b = $(a.currentTarget);
    window.open(b.attr("href"))
}), $(document).on("click", 'nav a[target="_top"]', function (a) {
    a.preventDefault();
    var b = $(a.currentTarget);
    window.location = b.attr("href")
}), $(document).on("click", 'nav a[href="#"]', function (a) {
    a.preventDefault()
}), $(window).on("hashchange", function () {
    checkURL()
})), $("body").on("click", function (a) {
    $('[rel="popover"], [data-rel="popover"]').each(function () {
        $(this).is(a.target) || 0 !== $(this).has(a.target).length || 0 !== $(".popover").has(a.target).length || $(this).popover("hide")
    })
}), $("body").on("hidden.bs.modal", ".modal", function () {
    $(this).removeData("bs.modal")
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
