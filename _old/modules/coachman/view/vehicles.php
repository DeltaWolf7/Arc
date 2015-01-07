<div class="page-header">
    <h1>Coach Manager :: Vehicles <?php
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
                    <tr>
                        <th>Reg No</th><th>Seats</th><th>Type</th><th>Cost p/m</th><th class="text-right"><button type="button" class="btn btn-primary btn-sm" onclick="window.location = '<?php echo arcGetModulePath() . "vehicles/new" ?>'"><i class="fa fa-plus"></i> Create</button></th>
                    </tr>
                    <?php
                    $vehicles = Vehicle::getAll();
                    foreach ($vehicles as $vehicle) {
                        $type = new VehicleType();
                        $type->getByID($vehicle->typeid);
                        echo "<tr><td><a href=\"" . arcGetModulePath() . "vehicles/" . $vehicle->id . "\">" . $vehicle->regno . "</a></td><td>" . $vehicle->seats . "</td><td>" . $type->name . "</td><td>£" . $vehicle->fuelcostpermile . "</td><td class=\"text-right\"><button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"window.location='" . arcGetModulePath() . "vehicles/" . $vehicle->id . "/delete" . "'\"><i class=\"fa fa-close\"></i> Delete</button></td></tr>";
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
                    ?>
                    Select a vehicle to edit or create a new one.
                    <?php
                } else {

                    $vehicle = new Vehicle();
                    if (arcGetURLData("data2") != "new") {
                        $vehicle->getByID(arcGetURLData("data2"));
                        if (arcGetURLData("data3")) {
                            $vehicle->delete(arcGetURLData("data2"));
                            echo "<script>window.location='" . arcGetModulePath() . "vehicles" . "';</script>";
                        }
                    }
                    ?>
                    <form role="form">
                        <div class="form-group">
                            <label for="regNo">Reg Number</label>
                            <input type="text" class="form-control text-uppercase" id="regNo" placeholder="Vehicle registration number" value="<?php echo $vehicle->regno; ?>" maxlength="10">
                        </div>
                        <div class="form-group">
                            <label for="seats">Seats</label>
                            <input type="text" class="form-control" id="seats" placeholder="Number of seats on the vehicle" value="<?php echo $vehicle->seats; ?>" maxlength="11">
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" id="type">
                                <?php
                                $types = VehicleType::getAll();
                                foreach ($types as $type) {
                                    echo "<option value=\"" . $type->id . "\"";
                                    if ($vehicle->typeid == $type->id) {
                                        echo " selected";
                                    }
                                    echo ">" . $type->name . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" id="id" value="<?php echo $vehicle->id; ?>" />
                        <div class="form-group">
                            <label for="fuel">Fuel Cost Per Mile</label>
                            <input type="text" class="form-control" id="fuel" placeholder="Cost of fuel per mile" value="<?php echo $vehicle->fuelcostpermile; ?>" maxlength="18">
                        </div>
                        <div class="text-right"><button type="button" class="btn btn-success btn-block" onclick="ajax.send('POST', {action: 'savevehicle', regNo: '#regNo', seats: '#seats', type: '#type', fuel: '#fuel', id: '#id'}, '<?php arcGetDispatch(); ?>', updateVehicles, true);"><i class="fa fa-save"></i> Save</button></div>
                    </form>
                    <?php
                }
                ?>
            </div></div>
    </div>
</div>
<script>
    function updateVehicles(data) {
        var data2 = data.split('|');
        if (data2[0] == "success")
        {
            window.location = "<?php echo arcGetModulePath() . "vehicles"; ?>";
        }
        updateStatus(data);
    }
</script>
