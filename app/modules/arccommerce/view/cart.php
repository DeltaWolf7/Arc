<div class="card">
    <div class="card-body">
        <?php

 // Load order
 $user = system\Helper::arcGetUser();
 $crmuser = null;
 if ($user != null) {
     $crmuser = CRMUser::getByUserIDAndCreate($user->id);
 }
 $order = new ArcEcomOrder();
 $orderitems = [];
 if (isset($_SESSION["order"])) {
     $order = ArcEcomOrder::getByID($_SESSION["order"]);
 }

 // Remove order line
 if (isset($_GET["rem"])) {
     $remove = ArcEcomOrderLine::getByID($_GET["rem"]);
     // Make sure the order line belongs to order, we don't want anything just deleting.
     if ($remove->id > 0 && $remove->orderid = $order->id) {
         $remove->delete();
     }
 }

 // User not set on order
 if ($user != null && $order->userid == 0) {
     $order->userid = $user->id;
 }

 // Add item
 if (isset($_POST["product"])) {

    // Order not yet saved, save it to get order id;
    if ($order->id == 0) {
        // default to royalmail
        $order->shippingtypeid = 3;
        $order->update();
    }

     $line = new ArcEcomOrderLine();
     $product = ArcEcomProduct::getByID($_POST["product"]);
     foreach ($_POST as $name => $value) {
         switch ($name) {
             case "product":
                 $line->productid = $_POST["product"];
                 $line->description = $product->name;
                 $line->qty = 1;
                 $line->cost = $product->cost;
                 $line->price = $product->price;
                 $line->orderid = $order->id;
             break;
             default:
             $line->options[] = $value;
         break;
         }
     }

     $line->update();
 }

 // load order lines
 $orderitems = ArcEcomOrderLine::getByOrderID($order->id);

 // Set delivery
 if (isset($_GET["del"])) {
     $newDel = ArcEcomDelivery::getByID($_GET["del"]);
     if ($newDel->id > 0 && $newDel->enabled == 1) {
        $order->shippingtypeid = $newDel->id;
     }
 }

 // shipping
 $del = ArcEcomDelivery::getByID($order->shippingtypeid);
 $shipping = 0.00;
 if ($del->id > 0) {
     $shipping = $del->price;
     $order->shippingprice = $del->price;
 }

 $paypal = SystemSetting::getByKey("ECOM_PAYPAL");

?>

        <?php

// So we have items?
 if (count($orderitems) > 0) { 
     ?>
        <div class="card-body px-4 px-lg-5">
            <div class="row mt-4">
                <div class="col-sm-6">
                    <div>
                        <div class="mt-1 mb-2 text-secondary-d1 text-600 text-125 fw-bold">
                            Billing\Delivery:
                        </div>

                        <div class="text-600 text-110 text-primary mt-2">
                            <?php
                    if ($user != null) {
                     echo $user->getFullname(); 
                    }
                     ?>
                        </div>

                        <div class="text-dark-l1">
                            <div class="my-1">
                                Use my PayPal details
                            </div>
                        </div>
                    </div>
                </div><!-- /.col -->

                <div class="col-sm-6 align-self-start d-sm-flex justify-content-end text-95">
                    <hr class="d-sm-none">
                    <div class="text-dark-l1">
                        <div class="mt-1 mb-2 text-secondary-d1 text-600 text-125 fw-bold">
                            Invoice
                        </div>

                        <div class="my-2">
                            <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                            <span class="text-600 text-90">
                                ID:
                            </span>
                            #<?php echo $order->id; ?>
                        </div>

                        <div class="my-2">
                            <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                            <span class="text-600 text-90">
                                Issue Date:
                            </span>
                            <?php echo system\Helper::arcConvertDate($order->date); ?>
                        </div>

                        <div class="my-2">
                            <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                            <span class="text-600 text-90">
                                Status:
                            </span>
                            <span class="badge bgc-green-d1 text-white badge-pill bg-success px-25">
                                New
                            </span>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div>
            <div class="mt-4">
                <div class="row text-600 text-95 text-secondary-d3 brc-purple-l1 py-25 border-y-2">
                    <div class="d-none d-sm-block col-1 text-primary">
                        Remove
                    </div>

                    <div class="d-none d-sm-block col-1 text-primary">
                        #
                    </div>

                    <div class="col-6 col-sm-4 text-primary">
                        Description
                    </div>

                    <div class="d-none d-sm-block col-4 col-sm-2 text-primary">
                        Qty
                    </div>

                    <div class="d-none d-sm-block col-sm-2 text-primary">
                        Unit Price
                    </div>

                    <div class="col-5 col-sm-2 text-primary">
                        Amount
                    </div>
                </div>

                <div class="text-95 text-dark-m3">

                    <?php
            $swt = "";
            $subtotal = 0.00;
            $weight = 0.0;
            foreach ($orderitems as $item) {
                $weightAtt = ArcEcomAttribute::getByProductIDAndType($item->productid, 10);
                if ($weightAtt->id > 0) {
                    $weight += $weightAtt->value;
                }
                $price = $item->price;

                if ($swt == "") {
                    $swt = " bg-light";
                } else {
                    $swt = "";
                }
        ?>

                    <div class="row mb-2 mb-sm-0 py-25<?php echo $swt; ?> mt-3">
                        <div class="d-none d-sm-block col-1 mt-3">
                            <button class="btn btn-danger btn-sm" onclick="remove(<?php echo $item->id; ?>)"><i
                                    class="far fa-window-close"></i></button>
                        </div>

                        <div class="d-none d-sm-block col-1 mt-3">
                            <?php echo $item->productid; ?>
                        </div>

                        <div class="col-6 col-sm-4">
                            <?php 
                    echo $item->description; 
                    if (count($item->options)) {
                        foreach ($item->options as $option) {
                            $opt = ArcEcomAttribute::getByID($option);
                            $type = ArcEcomAttributeType::getByID($opt->typeid);
                            echo "<br /><i class=\"text-muted text-small\">" . $type->name . ": " . $opt->value;
                            if ($opt->priceadjust > 0) {
                                echo " +£" . $opt->priceadjust;
                                $price += $opt->priceadjust;
                            }
                            echo "</i>";
                        }
                    }    
                ?>
                        </div>

                        <div class="d-none d-sm-block col-2 mt-3">
                            <?php echo $item->qty; ?>
                        </div>

                        <div class="d-none d-sm-block col-2 text-95 mt-3">
                            £<?php echo number_format($price, 2); ?>
                        </div>

                        <div class="col-5 col-sm-2 text-secondary-d3 text-600 mt-3">
                            £<?php echo number_format(($price * $item->qty), 2); ?>
                        </div>
                    </div>

                    <?php

                    $subtotal += $price;
            }
            $vatrate = 0.00;
            $vat = number_format(($subtotal * $vatrate) - $subtotal, 2); // should load from db. fake it.
            if ($vatrate == 0) {
                $vat = 0.00;
            }
            $total = $subtotal + $vat + $shipping;
            
        ?>
                </div>


                <div class="row mt-4">
                    <div class="col-md-8"></div>
                    <div class="col-md-2 text-right text-primary">
                        SubTotal
                    </div>

                    <div class="col-md-2">
                        <span class="text-125 text-secondary-d3">
                            £<?php echo number_format($subtotal, 2); ?>
                        </span>
                    </div>
                </div>

                <div class="row my-2">
                <div class="col-md-8"></div>
                    <div class="col-md-2 text-right text-primary">
                        VAT
                    </div>

                    <div class="col-md-2">
                        <span class="text-115 text-secondary-d3">
                            £<?php echo number_format($vat, 2); ?>
                        </span>
                    </div>
                </div>

                <div class="row my-2">
                <div class="col-md-8"></div>
                    <div class="col-md-2 text-right text-primary">
                        Weight
                    </div>

                    <div class="col-md-2">
                        <span class="text-115 text-secondary-d3">
                            <?php echo $weight; ?> kg
                        </span>
                    </div>
                </div>

                <div class="row my-2">
                <div class="col-md-8"></div>
                    <div class="col-md-2 text-right text-primary">
                        Delivery
                    </div>

                    <div class="col-md-2">
                        <span class="text-115 text-secondary-d3">
                            £<?php echo number_format($shipping, 2); ?>
                        </span>
                    </div>
                </div>

                <div class="row my-3 align-items-center p-2 radius-1">
                <div class="col-md-8"></div>
                    <div class="col-md-2 text-right text-110 fw-bolder">
                        Total
                    </div>

                    <div class="col-md-2">
                        <span class="text-200 fw-bolder">
                            £<?php echo number_format($total, 2); ?>
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <label for="DelType">Shipping Method</label>
                    <?php 
                        $delzero = "";
                        if ($order->shippingtypeid == 0) {
                            $delzero = " selected";
                        }
                        $delOptions = ArcEcomDelivery::getAllEnabled();
                        echo "<select id=\"DelType\" class=\"form-select\" onchange=\"updateDelivery()\">"
                            . "<option value=\"0\"" . $delzero . ">-- Select Delivery Method --</option>";
                        foreach ($delOptions as $delOpt) {
                            $dSel = "";
                            if ($delOpt->id == $order->shippingtypeid) {
                                $dSel = " selected";
                            }
                            if ($weight <= $delOpt->maxweightkg) {
                                echo "<option value=\"" . $delOpt->id . "\"" . $dSel . ">" . $delOpt->name 
                                    . " - £" . $delOpt->price . " - (" . $delOpt->maxweightkg . "kg max)</option>";
                            }
                        }
                        echo "</select>";
                        ?>
                        </div>
                </div>

                <?php 
    if ($order->shippingtypeid != 0) {
?>
                <div class="row">
                <div class="col-md-6"></div>
                    <div class="col-md-6 text-right" id="smart-button-container">
                        <div style="text-align: center;">
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo $paypal->value; ?>&currency=GBP"
                        data-sdk-integration-source="button-factory"></script>
                    <script>
                    function initPayPalButton() {
                        paypal.Buttons({
                            style: {
                                shape: 'rect',
                                color: 'white',
                                layout: 'vertical',
                                label: 'checkout',

                            },

                            createOrder: function(data, actions) {
                                return actions.order.create({
                                    purchase_units: [{
                                        "description": "Online Order <?php echo $order->id; ?>",
                                        "amount": {
                                            "currency_code": "GBP",
                                            "value": <?php echo $total; ?>,
                                            "breakdown": {
                                                "item_total": {
                                                    "currency_code": "GBP",
                                                    "value": <?php echo $subtotal; ?>
                                                },
                                                "shipping": {
                                                    "currency_code": "GBP",
                                                    "value": <?php echo $shipping; ?>
                                                },
                                                "tax_total": {
                                                    "currency_code": "GBP",
                                                    "value": <?php echo $vat; ?>
                                                }
                                            }
                                        }
                                    }]
                                });
                            },

                            onApprove: function(data, actions) {
                                return actions.order.capture().then(function(details) {
                                    arcAjaxRequest("arccommerce/processorder", {
                                        data: JSON.stringify(details),
                                        orderid: <?php echo $order->id; ?>
                                    }, null, arcprocess);
                                });
                            },

                            onError: function(err) {
                                console.log(err);
                            }
                        }).render('#paypal-button-container');
                    }
                    initPayPalButton();
                    </script>
                </div>

                <?php } else { 
                    if ($user == null) {
                        echo "<div class=\"alert alert-warning\"><i class=\"fas fa-exclamation-triangle\"></i> Select a delivery method</div>"; 
                    }
                     }?>
            </div>
        </div>


        <?php
            $order->total = $total;
            $order->subtotal = $subtotal;
            $order->vat = $vat;
            $order->weight = $weight;
            $order->update();
            $_SESSION["order"] = $order->id;    
            
            } else { 

                // if we have an order, but its empty, delete it.
                if ($order->id != 0 && isset($_SESSION["order"])) {
                    $order->delete();
                    unset($_SESSION["order"]);
                }
?>

        <div class="card">
            <div class="card-body">
                Your shopping cart is empty.
            </div>
        </div>

        <?php
            }
            ?>

    </div>
</div>
<script>
function arcprocess(data) {
    var jdata = arcGetJson(data);
    if (jdata.redirect) {
        window.location = jdata.redirect;
    }
}

var urlRaw = window.location.href.split('?')[0];

function updateDelivery() {
    window.location = urlRaw + "?del=" + $("#DelType").val();
}

function remove(lineid) {
    window.location = urlRaw + "?rem=" + lineid;
}
</script>