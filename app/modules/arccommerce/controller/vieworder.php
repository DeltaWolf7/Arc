<?php

$uri = system\Helper::arcGetURIAsArray(system\Helper::arcGetURI());

if (count($uri) > 1) {
    $data = explode("-", $uri[count($uri) - 1]);
    $order = ArcEcomOrder::GetByID($data[0]);
    $user = system\Helper::arcGetUser();

    if ($order->userid != $user->id) {
        system\Helper::arcRedirect("/");
    }
}