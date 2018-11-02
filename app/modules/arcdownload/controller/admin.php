<?php

if (!file_exists(system\Helper::arcGetPath(true) . "assets\arcdownload")) {
    mkdir(system\Helper::arcGetPath(true) . "assets\arcdownload");
}

system\Helper::arcAddFooter("js", system\Helper::arcGetModulePath() . "js/admin.js");