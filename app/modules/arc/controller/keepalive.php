<?php

if (system\Helper::arcIsAjaxRequest()) {
    $_SESSION["LAST_ACTIVITY"] = time();
}