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

    $title = SystemSetting::getByKey("ARC_SITETITLE");
    $logo = SystemSetting::getByKey("ARC_LOGO_PATH");

    $items = ArcEcomOrderLine::getByOrderID($order->id);
    $itemLines = "";
    foreach ($items as $item) {
        $itemLines .= "<tr class=\"item\"><td>" . $item->description . " x" . $item->qty . "<br />";
        foreach ($item->options as $option) {
            $opt = ArcEcomAttribute::getByID($option);
            $type = ArcEcomAttributeType::getByID($opt->typeid);
            $itemLines .= $type->name . " +&#163;" . $opt->priceadjust;
        }
        $itemLines .= "</td><td>&#163;" . ($item->price * $item->qty) . "</td></tr>";
    }
    
    // send email invoice
    $email = Email::getByKey("ARC_ECOM_ORDER");
    $message = html_entity_decode($email->text);
    $message = str_replace("{arc:sitetitle}", $title->value, $message);
    $message = str_replace("{arc:emailbilling}", $addresslines . "<br />" . $county . "<br />" . $postcode, $message);
    $message = str_replace("{arc:emaildelivery}", $addresslines . "<br />" . $county . "<br />" . $postcode, $message);
    $message = str_replace("{arc:emailstatus}", $order->status, $message);
    $message = str_replace("{arc:emailtotal}", $order->total, $message);   
    $message = str_replace("{arc:emailitems}", $itemLines, $message);
    $message = str_replace("{arc:sitelogo}", system\Helper::arcGetPath() . $logo->value, $message);

    $mail = new Mail();
    $mail->Send($user->email, $title->value . " Order " . $order->id, $message, true);

    system\Helper::arcReturnJSON(["redirect" => "/ordercomplete"]);
}