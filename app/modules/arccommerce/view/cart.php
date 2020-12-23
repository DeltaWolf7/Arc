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

 // Order not yet saved, save it to get order id;
 if ($order->id == 0) {
     $order->update();
 }

 // Add item
 if (isset($_POST["product"])) {
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
     if ($newDel->id > 0) {
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

<h2>Cart</h2>
<?php

// So we have items?
 if (count($orderitems) > 0) { 
     ?>
<div class="card-body px-4 px-lg-5">
    <div class="row mt-4">
        <div class="col-sm-6">
            <div>
                <div class="mt-1 mb-2 text-secondary-d1 text-600 text-125">
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
                <div class="mt-1 mb-2 text-secondary-d1 text-600 text-125">
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
                    <span class="badge bgc-green-d1 text-white badge-pill px-25">
                        New
                    </span>
                </div>
            </div>
        </div><!-- /.col -->
    </div>
    <div class="mt-4">
        <div class="row text-600 text-95 text-secondary-d3 brc-purple-l1 py-25 border-y-2">
            <div class="d-none d-sm-block col-1">
                Remove
            </div>

            <div class="d-none d-sm-block col-1">
                #
            </div>

            <div class="col-6 col-sm-4">
                Description
            </div>

            <div class="d-none d-sm-block col-4 col-sm-2">
                Qty
            </div>

            <div class="d-none d-sm-block col-sm-2">
                Unit Price
            </div>

            <div class="col-5 col-sm-2">
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
                    $swt = " bgc-purple-l4";
                } else {
                    $swt = "";
                }
        ?>

            <div class="row mb-2 mb-sm-0 py-25<?php echo $swt; ?>">
                <div class="d-none d-sm-block col-1 text-center">
                    <button class="btn btn-danger btn-sm" onclick="remove(<?php echo $item->id; ?>)"><i
                            class="far fa-window-close"></i></button>
                </div>

                <div class="d-none d-sm-block col-1">
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

                <div class="d-none d-sm-block col-2">
                    <?php echo $item->qty; ?>
                </div>

                <div class="d-none d-sm-block col-2 text-95">
                    £<?php echo $price; ?>
                </div>

                <div class="col-5 col-sm-2 text-secondary-d3 text-600">
                    £<?php echo ($price * $item->qty); ?>
                </div>
            </div>

            <?php

                    $subtotal += $price;
            }
            $vatrate = 0.00;
            $vat = round(($subtotal * $vatrate) - $subtotal, 2); // should load from db. fake it.
            if ($vatrate == 0) {
                $vat = 0.00;
            }
            $total = number_format($subtotal + $vat + $shipping, 2);
            
        ?>
        </div>

        <div class="row border-b-2 brc-purple-l1"></div>

        <div class="row mt-4">
            <div class="col-12 col-sm-7 mt-2 mt-lg-0">
                <label for="DelType">Shipping Method</label>
                <?php 
                        $delzero = "";
                        if ($order->shippingtypeid == 0) {
                            $delzero = " selected";
                        }
                        $delOptions = ArcEcomDelivery::getAll();
                        echo "<select id=\"DelType\" class=\"form-control\" onchange=\"updateDelivery()\">"
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


            <div class="col-12 col-sm-5 text-dark-l1 text-90 order-first order-sm-last">
                <div class="row my-2">
                    <div class="col-7 text-right">
                        SubTotal
                    </div>

                    <div class="col-5">
                        <span class="text-125 text-secondary-d3">
                            £<?php echo $subtotal; ?>
                        </span>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-7 text-right">
                        VAT
                    </div>

                    <div class="col-5">
                        <span class="text-115 text-secondary-d3">
                            £<?php echo $vat; ?>
                        </span>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-7 text-right">
                        Weight
                    </div>

                    <div class="col-5">
                        <span class="text-115 text-secondary-d3">
                            <?php echo $weight; ?> kg
                        </span>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-7 text-right">
                        Delivery
                    </div>

                    <div class="col-5">
                        <span class="text-115 text-secondary-d3">
                            £<?php echo $shipping; ?>
                        </span>
                    </div>
                </div>

                <div class="row my-3 align-items-center p-2 radius-1">
                    <div class="col-7 text-right text-110">
                        Total
                    </div>

                    <div class="col-5">
                        <span class="text-150">
                            £<?php echo $total; ?>
                        </span>
                    </div>
                </div>

                <?php 
    if ($order->shippingtypeid != 0) {
?>
                <div class="row">
                    <div class="col-12 text-right" id="smart-button-container">
                        <div style="text-align: center;">
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                    <script
                        src="https://www.paypal.com/sdk/js?client-id=<?php echo $paypal->value; ?>&currency=GBP"
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