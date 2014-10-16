<table class="table table-striped">
    <tr>
        <th>Reg No</th><th>Seats</th><th>Type</th><th>Cost p/m</th>
    </tr>
    <?php
        $vehicles = Vehicle::getAll();
        foreach ($vehicles as $vehicle) {
            $type = new VehicleType();
            $type->getByID($vehicle->typeid);
            echo "<tr><td>" . $vehicle->regno . "</td><td>" . $vehicle->seats . "</td><td>" . $type->name . "</td><td>" . $vehicle->fuelcostpermile . "</td></tr>";
        }
    ?>
</table>