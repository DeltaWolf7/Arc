<?php
    system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/style.css");
    system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/green.css");
    system\Helper::arcAddHeader("css", system\Helper::arcGetThemePath() . "css/sweet-alert.css");
   
    system\Helper::arcAddHeader("favicon", system\Helper::arcGetPath() . "assets/logo-48x48.png");
    
    system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/main.js");
    system\Helper::arcAddFooter("js", system\Helper::arcGetThemePath() . "js/sweet-alert.min.js");
