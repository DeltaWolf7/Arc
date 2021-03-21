<?php

if (system\Helper::arcIsAjaxRequest()) {
    $order = ArcEcomOrder::getByID($_POST["oid"]);

    $order->status = $_POST["status"];
    $order->tracking = strtoupper($_POST["tracking"]);
    $order->dropshiporder = strtoupper($_POST["dropship"]);
    $order->update();

    system\Helper::arcAddMessage("success", "Order updated");
    system\Helper::arcReturnJSON([]);
}