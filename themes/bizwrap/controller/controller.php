<?php

system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/bootstrap-responsive.min.css");
system\Helper::arcAddHeader("css", "http://fonts.googleapis.com/css?family=Open+Sans");
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/style.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/login.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/sweet-alert.css");


system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/sweet-alert.min.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/main.js");