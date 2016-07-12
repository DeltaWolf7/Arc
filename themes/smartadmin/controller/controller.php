<?php

system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/smartadmin-bootstrap.min.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/smartadmin-production-plugins.min.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/smartadmin-production.min.css");
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/smartadmin-skins.min.css");
system\Helper::arcAddHeader("css", "http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700");
system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/styles.css");

system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/SmartNotification.min.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/app.config.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/app.min.js");
system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/storage.js");