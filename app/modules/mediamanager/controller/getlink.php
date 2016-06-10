<?php

if (system\Helper::arcIsAjaxRequest()) {
    $marked = json_decode($_POST['items']);
    $path = system\Helper::arcGetPath() . "assets";
    $links = "";
    foreach ($marked as $item) {
        $links .= $path . $item . "\n\r";
    }

    system\Helper::arcReturnJSON(["links" => $links]);
}