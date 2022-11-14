<?php

system\Helper::arcAddHeader("external", "<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/sweetalert2@11.0.8/dist/sweetalert2.min.css\" integrity=\"sha256-XbNQS26OeX2zInBAmzkclM3Iyu0r5dHmlFoN/n5DbRg=\" crossorigin=\"anonymous\" defer>");
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/style.min.css");


system\Helper::arcAddFooter("external", "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11.0.8/dist/sweetalert2.all.min.js\" integrity=\"sha256-MlrZ8a1LrI3zM5T1y+sdLnorLQup57yD+J/rZZTn1R0=\" crossorigin=\"anonymous\" defer></script>");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/app.min.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/app.init.horizontal.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/app-style-switcher.js");

system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/custom.min.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/feather.min.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/perfect-scrollbar.jquery.min.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/sidebarmenu.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/sparkline.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/waves.js");

