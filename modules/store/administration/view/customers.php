<div class="container">
    <h3>Customers</h3>
    <div class="text-right">
        <button type="button" class="btn btn-default btn-sm" onclick="window.location='<?php echo arcGetModulePath() . "customers/view/0"; ?>'"><span class="fa fa-plus"></span> New Customer</button>
    </div>
    <p>
    <div class="panel panel-default">

        <table class="table table-striped">
            <tr><th>Name</th><th>Email</th><th>Phone</th></tr>
            <?php
            $group = UserGroup::getByName("Users");
            $customers = $group->getUsers();
            foreach ($customers as $customer) {
                echo "<tr><td><a href=\"" . arcGetModulePath() . "customers/view/" . $customer->id . "\"><span class=\"fa fa-user\"></span> " . $customer->getFullname() . "<a/></td><td><a href=\"" . arcGetModulePath() . "customers/mail/" . $customer->id . "\"><span class=\"fa fa-envelope\"></span> " . $customer->email . "<a/></td><td></td></tr>";
            }
            ?>
        </table>
    </div>
</p>
</div>