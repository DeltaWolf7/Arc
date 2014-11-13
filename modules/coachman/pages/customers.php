<div class="page-header">
    <h1>Coach Manager :: Customers <?php
        if (!empty(arcGetURLData("data1"))) {
            echo "<a href=\"" . arcGetModulePath() . "\"><span class=\"fa fa-arrow-circle-left\"></span></a>";
        }
        ?></h1>
</div>

<div class="row">
    <div class="col-sm-8">
        <table class="table table-striped">
            <tr><th>Firstname</th><th>Lastname</th><th>Email</th><th>Phone</th><th>Mobile</th><th><button type="button" class="btn btn-primary btn-sm" onclick="window.location = '<?php echo arcGetModulePath() . "/customers/0" ?>'"><span class="fa fa-plus"></span> Create</button></th></tr>
            <?php
            $customers = Customer::getAll();
            foreach ($customers as $customer) {
                echo "<tr><td><a href=\"" . arcGetModulePath() . "/customers/" . $customer->id . "\">" . $customer->firstname . "</a></td><td><a href=\"" . arcGetModulePath() . "/customers/" . $customer->id . "\">" . $customer->lastname . "</a></td><td>" . $customer->email . "</td><td>" . $customer->phone . "</td><td>" . $customer->mobile . "</td><td><button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"window.location='" . arcGetModulePath() . "/customers/" . $customer->id . "/delete'\"><span class=\"fa fa-remove\"></span> Delete</button></td></tr>";
            }
            ?>
        </table>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php
                if (arcGetURLData("data2") == null) {
                    echo "Select a customer to edit or create a new one.";
                } else {
                    ?>
                    <form>
                        <?php
                        $customer = new Customer();
                        if (arcGetURLData("data2") != "0") {
                            $customer->getByID(arcGetURLData("data2"));
                            if (arcGetURLData("data3")) {
                                $customer->delete(arcGetURLData("data2"));
                                echo "<script>window.location='" . arcGetModulePath() . "/customers" . "';</script>";
                            }
                        }
                        ?>
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input class="form-control" type="text" id="company" value="<?php echo $customer->company; ?>" maxlength="20" />
                        </div>
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input class="form-control" type="text" id="firstname" value="<?php echo $customer->firstname; ?>" maxlength="20" />
                        </div>
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input class="form-control" type="text" id="lastname" value="<?php echo $customer->lastname; ?>" maxlength="20" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="text" id="email" value="<?php echo $customer->email; ?>" maxlength="50" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input class="form-control" type="text" id="phone" value="<?php echo $customer->phone; ?>" maxlength="20" />
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input class="form-control" type="text" id="mobile" value="<?php echo $customer->mobile; ?>" maxlength="20" />
                        </div>
                        <button type="button" class="btn btn-success btn-block" onclick="ajax.send('POST', {action: 'savecustomer', firstname: '#firstname', lastname: '#lastname', email: '#email', phone: '#phone', mobile: '#mobile', id: '<?php echo $customer->id; ?>', company: '#company'}, '<?php arcGetDispatch(); ?>', updateCustomer, true);"><span class="fa fa-save"></span> Save</button>
                        <button type="button" class="btn btn-info btn-block" onclick="window.location = '<?php echo arcGetModulePath() . "/addresses/" . $customer->id; ?>'"><span class="fa fa-home"></span> Addresses</button>
                    </form>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    function updateCustomer(data) {
        var data2 = data.split('|');
        if (data2[0] == "success")
        {
            window.location = "<?php echo arcGetModulePath() . "/customers"; ?>";
        }
        updateStatus(data);
    }
</script>