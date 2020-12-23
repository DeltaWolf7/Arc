<?php
    if (!isset($_SESSION["order"])) {
        system\Helper::arcRedirect("/");
    }
    $order = ArcEcomOrder::getByID($_SESSION["order"]);
?>

<div class="card">
    <div class="card-body">
        <h3 class="card-title">Order Number #<?php echo $_SESSION["order"]; ?></h3>
        <p class="card-text">
            Thank you, we have your order.
        </p>
        <p class="card-text">
            We aim to process orders as soon as possible and will be in touch soon to update you on the progress.
        </p>
        <p class="card-text">
            Status: <?php echo $order->status; ?>
        </p>
    </div>
</div>


<?php

// destroy session
unset($_SESSION["order"]);