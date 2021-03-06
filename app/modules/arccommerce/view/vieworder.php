<?php
        $orderdata = explode("-", $uri[count($uri) - 1]);
        $order = ArcEcomOrder::getByID($orderdata[0]);
        if ($order->userid != system\Helper::arcGetUser()->id) {
            exit();
        }
?>

<div class="card">
    <div class="card-body">
        <div class="card-body px-4 px-lg-5">
            <div class="row mt-4">
                <div class="col-sm-6">
                    <div>
                        <div class="mt-1 mb-2 text-secondary-d1 text-600 text-125 fw-bold">
                            Billing\Delivery:
                        </div>

                        <div class="text-600 text-110 text-primary mt-2">
                        </div>

                        <div class="text-dark-l1">
                            <div class="my-1">
                                <?php
                            echo str_replace(PHP_EOL, "<br />", $order->shipping);
                        ?>
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
                            <i class="fa fa-circle text-blue-m2 text-xs mr-1" aria-hidden="true"></i>
                            <span class="text-600 text-90">
                                ID:
                            </span><?php echo $order->id; ?>
                        </div>

                        <div class="my-2">
                            <i class="fa fa-circle text-blue-m2 text-xs mr-1" aria-hidden="true"></i>
                            <span class="text-600 text-90">
                                Issue Date:
                            </span><?php echo $order->date; ?>
                        </div>

                        <div class="my-2">
                            <i class="fa fa-circle text-blue-m2 text-xs mr-1" aria-hidden="true"></i>
                            <span class="text-600 text-90">
                                Status:
                            </span>
                            <span class="badge bgc-green-d1 text-white badge-pill px-25 bg-success">
                                <?php echo $order->status; ?>
                            </span>
                        </div>

                        <div class="my-2">
                            <i class="fa fa-circle text-blue-m2 text-xs mr-1" aria-hidden="true"></i>
                            <span class="text-600 text-90">
                                Delivery Method:
                            </span>
                            <span>
                                <?php 
                        $del = ArcEcomDelivery::getByID($order->shippingtypeid);
                        echo $del->name;
                         ?>
                            </span>
                        </div>

                        <div class="my-2">
                            <i class="fa fa-circle text-blue-m2 text-xs mr-1" aria-hidden="true"></i>
                            <span class="text-600 text-90">
                                Tracking:
                            </span>
                            <span>
                                <?php echo $order->tracking; ?>
                            </span>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div>
            <div class="mt-4">
                <div class="row text-600 text-95 text-secondary-d3 brc-purple-l1 py-25 border-y-2">
                    <div class="d-none d-sm-block col-1 text-primary">
                        Model
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

                <?php

            $orderlines = ArcEcomOrderLine::getByOrderID($order->id);
            foreach ($orderlines as $orderline) {
                $price = $orderline->price;

        ?>
                <div class="text-95 text-dark-m3">


                    <div class="row mb-2 mb-sm-0 py-25 bgc-purple-l4">
                        <div class="d-none d-sm-block col-1">
                            <?php 
                  $prod = ArcEcomProduct::getByID($orderline->productid);
                  echo $prod->model; 
                  ?>
                        </div>



                        <div class="col-6 col-sm-4">
                            <?php
                    echo $orderline->description; 
                    if (count($orderline->options)) {
                        foreach ($orderline->options as $option) {
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
                            <?php echo $orderline->qty; ?> </div>

                        <div class="d-none d-sm-block col-2 text-95">
                            £<?php echo $price; ?> </div>

                        <div class="col-5 col-sm-2 text-secondary-d3 text-600">
                            £<?php echo ($price * $orderline->qty); ?> </div>
                    </div>

                </div>

                <?php
            }
            ?>

                <div class="row border-b-2 brc-purple-l1"></div>

                <div class="row mt-4">
                    <div class="col-12 col-sm-7 mt-2 mt-lg-0">
                    </div>


                    <div class="col-12 col-sm-5 text-dark-l1 text-90 order-first order-sm-last">
                        <div class="row my-2">
                            <div class="col-7 text-right">
                                SubTotal
                            </div>

                            <div class="col-5">
                                <span class="text-125 text-secondary-d3">
                                    £<?php echo $order->subtotal; ?>
                                </span>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-7 text-right">
                                VAT
                            </div>

                            <div class="col-5">
                                <span class="text-115 text-secondary-d3">
                                    £<?php echo $order->vat; ?>
                                </span>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-7 text-right">
                                Weight
                            </div>

                            <div class="col-5">
                                <span class="text-115 text-secondary-d3">
                                    <?php echo $order->weight; ?> kg
                                </span>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-7 text-right">
                                Delivery
                            </div>

                            <div class="col-5">
                                <span class="text-115 text-secondary-d3">
                                    £<?php echo $order->shippingprice; ?> </span>
                            </div>
                        </div>

                        <div class="row my-3 align-items-center p-2 radius-1">
                            <div class="col-7 text-right text-110 fw-bold">
                                Total
                            </div>

                            <div class="col-5">
                                <span class="text-150 fw-bold">
                                    £<?php echo $order->total; ?> </span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>