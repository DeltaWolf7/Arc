$(function () {
	"use strict";
	$(".mobile-toggle-menu").on("click", function () {
		$(".wrapper").addClass("toggled")
	}), $(".toggle-icon").click(function () {
		$(".wrapper").hasClass("toggled") ? ($(".wrapper").removeClass("toggled"), $(".sidebar-wrapper").unbind("hover")) : ($(".wrapper").addClass("toggled"), $(".sidebar-wrapper").hover(function () {
			$(".wrapper").addClass("sidebar-hovered")
		}, function () {
			$(".wrapper").removeClass("sidebar-hovered")
		}))
	}), $(document).ready(function () {
		$(window).on("scroll", function () {
			$(this).scrollTop() > 300 ? $(".back-to-top").fadeIn() : $(".back-to-top").fadeOut()
		}), $(".back-to-top").on("click", function () {
			return $("html, body").animate({
				scrollTop: 0
			}, 600), !1
		})
	}), $(function () {
		for (var e = window.location, o = $(".metismenu li a").filter(function () {
				return this.href == e
			}).addClass("").parent().addClass("mm-active"); o.is("li");) o = o.parent("").addClass("mm-show").parent("").addClass("mm-active")
	}), $(function () {
		$("#menu").metisMenu()
	})

    var ps1 = new PerfectScrollbar('.sidebar-wrapper');
    var ps2 = new PerfectScrollbar('.sidebar');
    $('html').addClass('perfect-scrollbar-on');
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

	Swal.fire({
		title: title,
		text: data.messages.message,
		icon: type,
		confirmButtonText: 'OK'
	  })
}