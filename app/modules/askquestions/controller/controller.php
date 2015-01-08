<?php

system\Helper::arcAddHeader("css", system\Helper::arcGetPath() . "app/modules/askquestions/css/styles.css");

if (system\Helper::arcGetURLData("action") == null) {
    system\Helper::arcOverrideView("questions");
}
