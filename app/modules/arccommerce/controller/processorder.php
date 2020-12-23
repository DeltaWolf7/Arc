<?php

if (system\Helper::arcIsAjaxRequest()) {

    $data = json_decode($_POST["data"]);
    $orderid = $_POST["orderid"];
    $user = $user = User::getByEmail($data->payer->email_address);
    if ($user->id == 0) {
        $user = new User();
        $user->email = $data->payer->email_address;
        $password = md5(uniqid($user->email, true));
        $user->setPassword($password);
        $user->firstname = $data->payer->name->given_name;
        $user->lastname = $data->payer->name->surname;
        $user->enabled = 1;
        $user->update();
    }

    $name = $data->payer->name->given_name . " " . $data->payer->name->surname;

    $order = ArcEcomOrder::getByID($orderid);
    $order->paymentdata = $data;
    $order->userid = $user->id;

    // https://developer.paypal.com/docs/api/orders/v2/#orders_capture
    switch ($data->status) {
        case "COMPLETED":
            $order->status = "PENDING";
            break;
        case "APPROVED":
        case "CREATED":
        case "SAVED":
        case "PAYER_ACTION_REQUIRED":
            $order->status = "Waiting Payment";
            break;
        case "VOIDED":
            $order->status = "Payment Failure";
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
    $order->shipping = $name . PHP_EOL . $shipping->address_line_1 . PHP_EOL . $shipping->admin_area_2
         . PHP_EOL . $county = $shipping->admin_area_1 . PHP_EOL . $shipping->postal_code;
    $order->billing = $name . PHP_EOL . $shipping->address_line_1 . PHP_EOL . $shipping->admin_area_2
        . PHP_EOL . $county = $shipping->admin_area_1 . PHP_EOL . $shipping->postal_code;

    $order->update();
    

    // send email invoice
    $password = md5(uniqid($user->email, true));
    $messageS = SystemSetting::getByKey("ECOM_EMAILINVOICE");
    $message = html_entity_decode($messageS->value);
    $message = str_replace("{password}", $password, $message);

    $mail = new Mail();
    $mail->Send($user->email, "Order " . $order->id, $message, true);

    system\Helper::arcReturnJSON(["redirect" => "/ordercomplete"]);
}