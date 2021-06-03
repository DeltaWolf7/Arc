<?php

system\Helper::arcAddHeader("external", "<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/sweetalert2@11.0.8/dist/sweetalert2.min.css\" integrity=\"sha256-XbNQS26OeX2zInBAmzkclM3Iyu0r5dHmlFoN/n5DbRg=\" crossorigin=\"anonymous\" defer>");
system\Helper::arcAddHeader("external", '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" integrity="sha512-n+g8P11K/4RFlXnx2/RW1EZK25iYgolW6Qn7I0F96KxJibwATH3OoVCQPh/hzlc4dWAwplglKX8IVNVMWUUdsw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer/>');
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/metisMenu.min.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/app.min.css");

system\Helper::arcAddFooter("external", "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11.0.8/dist/sweetalert2.all.min.js\" integrity=\"sha256-MlrZ8a1LrI3zM5T1y+sdLnorLQup57yD+J/rZZTn1R0=\" crossorigin=\"anonymous\" defer></script>");
system\Helper::arcAddFooter("external", '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js" integrity="sha512-yUNtg0k40IvRQNR20bJ4oH6QeQ/mgs9Lsa6V+3qxTj58u2r+JiAYOhOW0o+ijuMmqCtCEg7LZRA+T4t84/ayVA==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>');
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/metisMenu.min.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/app.min.js");
