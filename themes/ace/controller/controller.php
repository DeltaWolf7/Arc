<?php

system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/bootstrap.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/ace-font.min.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/ace.min.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/ace-themes.min.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/sweetalert2.min.css");

system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/ace.min.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/sweetalert2.min.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/site.js");