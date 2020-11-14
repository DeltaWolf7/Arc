<?php

if (system\Helper::arcIsAjaxRequest()) {

    $user = system\Helper::arcGetUser();

    $data = json_decode($_POST["data"]);
    $orderid = $_POST["orderid"];

    $order = ArcEcomOrder::getByID($orderid);
    $order->paymentdata = $data;

    // https://developer.paypal.com/docs/api/orders/v2/#orders_capture
    switch ($data->status) {
        case "COMPLETED":
        case "APPROVED":
            $order->status = 2;
            break;
        case "CREATED":
        case "SAVED":
        case "PAYER_ACTION_REQUIRED":
            $order->status = 9;
            break;
        case "VOIDED":
            $order->status = 4;
            break;
    }


    // Get all payal delivery details
    $addresslines = "";
    $county = "";
    $postcode = "";

    foreach ($data->purchase_units as $paydata) {
        foreach ($paydata->shipping as $shipping) {
            if (isset($shipping->address_line_1)) {
                $addresslines = $shipping->address_line_1 . PHP_EOL . $shipping->admin_area_2;
                $county = $shipping->admin_area_1;
                $postcode = $shipping->postal_code;
            }
        }
    }

    // Check if we have the address
    $shipto = null;
    $addresses = CRMUserAddress::getAllByUserID($user->id);
    foreach ($addresses as $address) {
        if ($address->addresslines == $addresslines && $address->postcode == $postcode) {
            $shipto = $address;
        }
    }

    // Dont have the address, create it
    if ($shipto == null) {
        $shipto = new CRMUserAddress();
        $shipto->userid = $user->id;
        $shipto->addresslines = $addresslines;
        $shipto->county = $county;
        $shipto->postcode = $postcode;
        $shipto->isbilling = true;
        $shipto->isdelivery = true;
        $shipto->update();
    }

    // Set order addresses
    $order->shippingid = $shipto->id;
    $order->billingid = $shipto->id;

    $order->update();

    system\Helper::arcReturnJSON(["redirect" => "/ordercomplete"]);

}