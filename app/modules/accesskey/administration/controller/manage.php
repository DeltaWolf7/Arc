<?php

if (system\Helper::arcIsAjaxRequest() == true) {
    if (isset($_POST["user"])) {
        AccessKey::createKey($_POST["user"]);
    }
}