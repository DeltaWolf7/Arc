<div class="page-header">
    <h1>Coach Manager :: Bookings <?php
        if (!empty(arcGetURLData("data1"))) {
            echo "<a href=\"" . arcGetModulePath() . "\"><i class=\"fa fa-arrow-circle-left\"></i></a>";
        }
        ?></h1>
</div>

<?php
$booking = new Booking();
if (arcGetURLData("data3") != null) {
    $booking->getByID(arcGetURLData("data3"));
}
?>

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
                        <input type="text" class="form-control" id="journeydatedata" data-date-format="DD/MM/YYYY">
                        <i class="input-group-addon"><i class="fa fa-calendar"></i></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date">Order Date</label>
                    <input id="date" type="text" class="form-control" disabled="true" value="<?php $date = new DateTime($booking->orderdate);
echo $date->format("d/m/Y"); ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="ref">Reference</label>
                    <input id="ref" type="text" class="form-control" disabled="true" value="<?php echo $booking->reference; ?>">
                </div>
                <div class="form-group">
                    <label for="ref">Coach</label>
                    <select class="form-control" id="coach">
                        <?php
                        $vehicles = Vehicle::getAll();
                        foreach ($vehicles as $vehicle) {
                            $type = new VehicleType();
                            $type->getByID($vehicle->typeid);
                            echo "<option value=\"" . $vehicle->id . "\"";
                            if ($booking->coachsize == $vehicle->id) {
                                echo " selected";
                            }
                            echo ">Type: " . $type->name . ", Seats: " . $vehicle->seats . "</option>";
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
                    <div class="input-group">
                        <input id="customer" type="text" class="form-control" value="<?php echo $booking->customername; ?>">
                        <i class="input-group-addon"><i class="fa fa-search"></i></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" class="form-control" rows="5"><?php echo $booking->address; ?></textarea>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Costing Information
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="cost">Cost</label>
                    <input id="cost" type="text" class="form-control" value="<?php echo $booking->cost; ?>">
                </div>
                <div class="form-group">
                    <label for="deposit">Deposit</label>
                    <input id="deposit" type="text" class="form-control" value="<?php echo $booking->deposit; ?>">
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
                                <input id="from" type="text" class="form-control" value="<?php echo $booking->departureaddress; ?>">
                            </div>
                            <div id="viaDiv"></div>
                            <div class="form-group">
                                <label for="arrive">Destination</label>
                                <input id="arrive" type="text" class="form-control" value="<?php echo $booking->destination; ?>">
                            </div>
                            <div class="form-group">
                                <label for="arrive">Return</label>
                                <input id="returnplace" type="text" class="form-control" value="<?php echo $booking->returnplace; ?>">
                            </div>


                            <button type="button" class="btn btn-primary" onclick="updateMap();" /><i class="fa fa-road"></i> Get Directions</button> 
                            <button type="button" class="btn btn-default" onclick="addViaRow();"><i class="fa fa-plus"> Via</i></button>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="departtime">Depart time</label>
                                <div class="input-group date" id="departtimepicker">                           
                                    <input id="departuretime" type="text" class="form-control" data-date-format="HH:mm" value="<?php echo $booking->departuretime; ?>">
                                    <i class="input-group-addon"><i class="fa fa-clock-o"></i></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="departtime">Arrival time</label>
                                <div class="input-group date" id="departtimepicker">                           
                                    <input type="text" class="form-control" data-date-format="HH:mm" value="<?php echo $booking->arrivaltime; ?>" id="arrivaltime">
                                    <i class="input-group-addon"><i class="fa fa-clock-o"></i></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="returndate">Return Date</label>
                                <div class="input-group date" id="returndatepicker">                           
                                    <input type="text" class="form-control" id="returndate" data-date-format="DD/MM/YYYY">
                                    <i class="input-group-addon"><i class="fa fa-calendar"></i></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="departtime">Return Time</label>
                                <div class="input-group date" id="returntimepicker">                           
                                    <input id="returntime" type="text" class="form-control" data-date-format="HH:mm" value="<?php echo $booking->returntime; ?>">
                                    <i class="input-group-addon"><i class="fa fa-clock-o"></i></i>
                                </div>
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
                    <label for="company">Company</label>
                    <input id="company" type="text" class="form-control" value="<?php echo $booking->company; ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input id="phone" type="text" class="form-control" value="<?php echo $booking->phone; ?>">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input id="mobile" type="text" class="form-control" value="<?php echo $booking->mobile; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" value="<?php echo $booking->email; ?>">
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
                        <i class="fa fa-bus fa-3x"></i><br />
                        <i class="fa fa-road fa-5x"></i><br />
                        No route planned
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<p class="text-right"><button type="button" class="btn btn-success" onclick="ajax.send('POST', {action: 'savebooking', departuretime: '#departuretime', returntime: '#returntime', returnplace: '#returnplace', deposit: '#deposit', cost: '#cost', company: '#company', journeydate: '#journeydatedata', orderdate: '#date', reference: '#ref', coach: '#coach', customer: '#customer', address: '#address', from: '#from', destination: '#arrive', returndate: '#returndate', arrivaltime: '#arrivaltime', email: '#email', phone: '#phone', mobile: '#mobile', id: '<?php echo $booking->id; ?>'}, '<?php arcGetDispatch(); ?>', updateStatus, true);"><i class="fa fa-save"></i> Save</button></p>

<script>
    $(function () {
        $('#departtimepicker').datetimepicker({
            pickDate: false
        });
    });
    $(function () {
        $('#journeydate').datetimepicker({
            defaultDate: <?php $jdate = new DateTime($booking->journeydate);
                        echo "\"" . $jdate->format("d/m/Y") . "\""; ?>,
            pickTime: false
        });
    });
    $(function () {
        $('#returndatepicker').datetimepicker({
            defaultDate: <?php $rdate = new DateTime($booking->returndate);
                        echo "\"" . $rdate->format("d/m/Y") . "\""; ?>,
            pickTime: false
        });
    });
    $(function () {
        yy
        $('#returntimepicker').datetimepicker({
            pickTime: true,
            pickDate: false
        });
    });
</script>

<script>
    var count = 1;
    function addViaRow() {
        var via = document.getElementById('viaDiv');
        via.innerHTML += '<div class="form-group"><label for="via' + count + '">Via</label><input id="via' + count + '" type="text" class="form-control"></div>';
        $('html,body').animate({scrollTop: $("#via" + count).offset().top}, 'slow');
        count++;
    }
</script>

<script>
    function updateMap() {
        var from = document.getElementById('from').value;
        if (from == '') {
            updateStatus('danger|Invalid depature location.');
            return;
        }
        var to = document.getElementById('arrive').value;
        if (to == '') {
            updateStatus('danger|Invalid arrival location.');
            return;
        }
        var viaCode = '';
        for (i = 1; i < 50; i++) {
            try {
                var via = document.getElementById('via' + i).value;
                if (via != '') {
                    viaCode = viaCode + '|' + via;
                }
            } catch (err) {
                break;
            }
        }
        viaCode = viaCode.substring(1, viaCode.length);
        var key = 'AIzaSyC2acbgzDMvZcXJNtDDdrlMPfNScTH3tv4';
        var code = '<iframe width="100%" height="500px" frameborder="0" style="border:0" src="';
        code += 'https://www.google.com/maps/embed/v1/directions?key=' + key + '&origin=' + from + '&destination=' + to + '&avoid=tolls|highways&mode=driving';
        if (viaCode != '') {
            code += '&waypoints=' + viaCode;
        }
        code += '"></iframe>';
        var view = document.getElementById('map');
        view.innerHTML = code;
        $('html,body').animate({scrollTop: $("#map").offset().top}, 'slow');
    }
</script>
