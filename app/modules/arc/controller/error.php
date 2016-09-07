<?php

http_response_code(system\Helper::arcGetPostData("error"));

$error = system\Helper::arcGetPostData("error")
        . ": "
        . system\Helper::arcGetPostData("path");

if (!empty($_SERVER["HTTP_REFERER"])) {
    $error .= " (ref: " . $_SERVER["HTTP_REFERER"] . ")";
}


Log::createLog("danger", "error", $error);

