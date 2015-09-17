<?php

system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "app/modules/askquestions/css/styles.css");
system\Helper::arcAddHeader("js", system\Helper::arcGetPath() . "app/modules/askquestions/js/summernote-plugins.js");

if (system\Helper::arcGetURLData("action") == null) {
    system\Helper::arcOverrideView("groups", true);
}
