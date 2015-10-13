<?php

if (system\Helper::arcGetURLData("action") == null) {
    system\Helper::arcOverrideView("manager", true);
}

system\Helper::arcAddFooter("js", system\Helper::arcGetModuleAbsolutePath(true) . "js/page.js");