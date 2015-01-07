<div class="page-header">
    <h1>Coach Manager :: Drivers <?php
        if (!empty(arcGetURLData("data1"))) {
            echo "<a href=\"" . arcGetModulePath() . "\"><i class=\"fa fa-arrow-circle-left\"></i></a>";
        }
        ?></h1>
</div>

<div class="row">

    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped">
                    <tr><th>Firstname</th><th>Lastname</th><th>Email</th><th>Phone</th><th>Mobile</th><th>Cost P/H</th><th><button type="button" class="btn btn-primary btn-sm" onclick="window.location = '<?php echo arcGetModulePath() . "drivers/0" ?>'"><i class="fa fa-plus"></i> Create</button></th></tr>
                    <?php
                    $drivers = Driver::getAll();
                    foreach ($drivers as $driver) {
                        echo "<tr><td><a href=\"" . arcGetModulePath() . "drivers/" . $driver->id . "\">" . $driver->firstname . "</a></td><td><a href=\"" . arcGetModulePath() . "drivers/" . $driver->id . "\">" . $driver->lastname . "</a></td><td>" . $driver->email . "</td><td>" . $driver->phone . "</td><td>" . $driver->mobile . "</td><td>£" . $driver->costperhour . "</td><td><button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"window.location='" . arcGetModulePath() . "drivers/" . $driver->id . "/delete'\"><i class=\"fa fa-remove\"></i> Delete</button></td></tr>";
                    }
                    ?>
                </table>
            </div></div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php
                if (arcGetURLData("data2") == null) {
                    echo "Select a driver to edit or create a new one.";
                } else {
                    ?>
                    <form>
                        <?php
                        $driver = new Driver();
                        if (arcGetURLData("data2") != "0") {
                            $driver->getByID(arcGetURLData("data2"));
                            if (arcGetURLData("data3")) {
                                $driver->delete(arcGetURLData("data2"));
                                echo "<script>window.location='" . arcGetModulePath() . "drivers" . "';</script>";
                            }
                        }
                        ?>
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input class="form-control" type="text" id="firstname" value="<?php echo $driver->firstname; ?>" maxlength="20" />
                        </div>
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input class="form-control" type="text" id="lastname" value="<?php echo $driver->lastname; ?>" maxlength="20" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="text" id="email" value="<?php echo $driver->email; ?>" maxlength="50" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input class="form-control" type="text" id="phone" value="<?php echo $driver->phone; ?>" maxlength="10" />
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input class="form-control" type="text" id="mobile" value="<?php echo $driver->mobile; ?>" maxlength="10" />
                        </div>
                        <div class="form-group">
                            <label for="cost">Cost Per Hour</label>
                            <input class="form-control" type="text" id="cost" value="<?php echo $driver->costperhour; ?>" maxlength="10" />
                        </div>
                        <button type="button" class="btn btn-success btn-block" onclick="ajax.send('POST', {action: 'savedriver', firstname: '#firstname', lastname: '#lastname', email: '#email', phone: '#phone', mobile: '#mobile', id: '<?php echo $driver->id; ?>', cost: '#cost'}, '<?php arcGetDispatch(); ?>', updateDrivers, true);"><i class="fa fa-save"></i> Save</button>
                    </form>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    function updateDrivers(data) {
        var data2 = data.split('|');
        if (data2[0] == "success")
        {
            window.location = "<?php echo arcGetModulePath() . "drivers"; ?>";
        }
        updateStatus(data);
    }
</script>