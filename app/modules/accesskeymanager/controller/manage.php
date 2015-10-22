<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if (isset($_POST["user"])) {
        AccessKey::createKey($_POST["user"]);
    }
} else {
    system\Helper::arcAddFooter("js", system\Helper::arcGetModuleAbsolutePath(true) . "js/manage.js");
}