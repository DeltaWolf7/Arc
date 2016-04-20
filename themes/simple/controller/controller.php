<?php
    system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/style.min.css");
    system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/sweet-alert.css");
   
    system\Helper::arcAddHeader("favicon", system\Helper::arcGetThemePath() . "images/logo-48x48.png");
    
    system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/core.min.js");
    system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/main.js");
    system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/sweet-alert.min.js");
