<div class="page-header">
    <h1>Coach Manager :: Bookings <?php
        if (!empty(arcGetURLData("data1"))) {
            echo "<a href=\"" . arcGetModulePath() . "\"><span class=\"fa fa-arrow-circle-left\"></span></a>";
        }
        ?></h1>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Booking Information
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">

                <div class="form-group">
                    <label for="journeydate">Journey Date</label>
                    <div class="input-group date" id="journeydate">                           
                        <input type="text" class="form-control">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>

                    </div>
                </div>
                <div class="form-group">
                    <label for="date">Booking Date</label>
                    <input id="date" type="text" class="form-control" disabled="true" value="<?php echo date("d/m/y"); ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="ref">Reference</label>
                    <input id="ref" type="text" class="form-control" disabled="true" value="SOMEVALUE">
                </div>
                <div class="form-group">
                    <label for="ref">Coach</label>
                    <select class="form-control">
                        <?php
                        $vehicles = Vehicle::getAll();
                        foreach ($vehicles as $vehicle) {
                            $type = new VehicleType();
                            $type->getByID($vehicle->typeid);
                            echo "<option value=\"" . $vehicle->id . "\">Type: " . $type->name . ", Reg: " . $vehicle->regno . ", Seats: " . $vehicle->seats . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">



        <div class="panel panel-default">
            <div class="panel-heading">
                Customer Details
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="customer" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input id="address" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Route Planning
            </div>
            <div class="panel-body">
                <form>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="from">Departure</label>
                                <input id="from" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="arrive">Arrival</label>
                                <input id="arrive" type="text" class="form-control">
                            </div>
                            <div id="viaDiv"></div>
                            <div class="form-group">
                                <label for="returndate">Return Date</label>
                                <div class="input-group date" id="returntimepicker">                           
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-default" onclick="updateMap();" />Get Directions</button>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="departtime">Depart time</label>
                                <div class="input-group date" id="departtimepicker">                           
                                    <input type="text" class="form-control" data-date-format="HH:mm" value="00:00">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="departtime">Arrival time</label>
                                <div class="input-group date" id="departtimepicker">                           
                                    <input type="text" class="form-control" data-date-format="HH:mm" value="00:00">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-default btn-sm btn-block" onclick="addViaRow();"><span class="fa fa-plus"> Add Via</span></button>
                            </div>

                        </div>
                    </div>
                </form>
            </div></div>       

    </div>
    <div class="col-sm-6">


        <div class="panel panel-default">
            <div class="panel-heading">
                Contact Details
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input id="phone" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input id="mobile" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Route Overview
            </div>
            <div class="panel-body">
                <div id="map">
                    <div class="text-center">
                        <span class="fa fa-bus fa-3x"></span><br />
                        <span class="fa fa-road fa-5x"></span><br />
                        No route planned
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    $(function () {
        $('#departtimepicker').datetimepicker({
            pickDate: false
        });
    });
    $(function () {
        $('#journeydate').datetimepicker({
            pickTime: false
        });
    });
    $(function () {
        $('#returntimepicker').datetimepicker({
            pickTime: false
        });
    });
</script>

<script>
    var count = 1;
    function addViaRow() {
        var via = document.getElementById('viaDiv');
        via.innerHTML = via.innerHTML + '<div class="form-group"><label for="via' + count + '">Via</label><input id="via' + count + '" type="text" class="form-control"></div>';
    }
</script>

<script>
    function updateMap() {
        var from = document.getElementById('from').value;
        var to = document.getElementById('arrive').value;
        var viaCode = '';
        for (i = 1; i < 50; i++) {
            var via = document.getElementById('via' + i).value;
            if (via != null) {
                viaCode = viaCode . '|' . via;
            } else {
                break;
            }
        }    
        var code = '<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyC2acbgzDMvZcXJNtDDdrlMPfNScTH3tv4&origin=' + from + '&destination=' + to + '&avoid=tolls|highways&waypoints=' + viaCode + '"></iframe>';
        var view = document.getElementById('map');
        view.innerHTML = code;
    }
</script>
