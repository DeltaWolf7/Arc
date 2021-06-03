<div class="card">
    <div class="card-body">

<table class="table table-striped">
    <tr class="text-primary">
        <th>Order #</th>
        <th>Date</th>
        <th>Status</th>
        <th>Tracking</th>
        <th>Total</th>
        <th></th>
    </tr>
    <?php
        $user = system\Helper::arcGetUser();
        $orders = ArcEcomOrder::getByUserID($user->id);

        foreach ($orders as $order) {
            ?>
                <tr>
                <td><?php echo $order->id; ?></td>
                <td><?php echo system\Helper::arcConvertDateTime($order->date); ?></td>
                <td><?php echo $order->status; ?></td>
                <td><?php echo $order->tracking; ?></td>
                <td>£<?php echo $order->total; ?></td>
                <td><a href="/vieworder/<?php echo $order->id; ?>" class="btn btn-primary btn-sm">View</a></td>
                </tr>
            <?php
        }
    ?>
</table>
</div>
</div>