<div class="page-header">
    <h1>Store Customers</h1>
</div>
<div class="text-right">
    <button type="button" class="btn btn-default btn-sm" onclick="window.location = '<?php echo system\Helper::arcGetModulePath() . "customers/view/0"; ?>'"><span class="fa fa-plus"></span> New Customer</button>
</div>
<p>
<table class="table table-striped">
    <tr><th>Name</th><th>Email</th><th>Phone</th></tr>
    <?php
    $group = UserGroup::getByName("Users");
    $customers = $group->getUsers();
    foreach ($customers as $customer) {
        echo "<tr><td><a href=\"" . system\Helper::arcGetModulePath() . "customers/view/" . $customer->id . "\"><span class=\"fa fa-user\"></span> " . $customer->getFullname() . "<a/></td><td><a href=\"" . system\Helper::arcGetModulePath() . "customers/mail/" . $customer->id . "\"><span class=\"fa fa-envelope\"></span> " . $customer->email . "<a/></td><td></td></tr>";
    }
    ?>
</table>
</p>
