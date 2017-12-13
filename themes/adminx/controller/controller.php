<?php

system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/main.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/all-themes.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/overrides.css");

system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/libscripts.bundle.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/vendorscripts.bundle.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/mainscripts.bundle.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/bootstrap-notify.min.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/overrides.js");