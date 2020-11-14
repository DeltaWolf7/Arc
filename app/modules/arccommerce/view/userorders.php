<h3>My Orders</h3>

<table class="table table-striped">
    <tr>
        <th>Order #</th>
        <th>Date</th>
        <th>Status</th>
        <th>Items</th>
        <th>Total</th>
        <th></th>
    </tr>
    <?php
        $user = system\Helper::arcGetUser();
        $orders = ArcEcomOrder::getByUserID($user->id);

        foreach ($orders as $order) {
            $status = ArcEcomOrderStatus::getByID($order->status);
            $items = ArcEcomOrderLine::getByOrderID($order->id);
            ?>
                <tr>
                <td><?php echo $order->id; ?></td>
                <td><?php echo system\Helper::arcConvertDateTime($order->date); ?></td>
                <td><?php echo $status->name; ?></td>
                <td><?php echo count($items); ?></td>
                <td>£<?php echo $order->total; ?></td>
                <td><a href="/vieworder/<?php echo $order->id; ?>" class="btn btn-primary btn-sm">View</a></td>
                </tr>
            <?php
        }
    ?>
</table>