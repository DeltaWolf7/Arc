<?php

if (system\Helper::arcGetURLData("action") == null) {
    system\Helper::arcOverrideView("details");
}

system\Helper::arcAddFooter("js", system\Helper::arcGetModuleAbsolutePath(true) . "js/user.js");