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
                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>

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
                    <div class="input-group">
                        <input id="customer" type="text" class="form-control">
                        <span class="input-group-addon"><span class="fa fa-search"></span></span>
                    </div>
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
                                    <span class="input-group-addon"><span class="fa fa-clock"></span></span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="updateMap();" /><span class="fa fa-road"></span> Get Directions</button> 
                            <button type="button" class="btn btn-default" onclick="addViaRow();"><span class="fa fa-plus"> Via</span></button>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="departtime">Depart time</label>
                                <div class="input-group date" id="departtimepicker">                           
                                    <input type="text" class="form-control" data-date-format="HH:mm" value="00:00">
                                    <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="departtime">Arrival time</label>
                                <div class="input-group date" id="departtimepicker">                           
                                    <input type="text" class="form-control" data-date-format="HH:mm" value="00:00">
                                    <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
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
                <div class="row">
                    <div class="col-sm-6">Route Overview</div>
                    <div class="col-sm-6 text-right"><button type="button" class="btn btn-default btn-xs" onclick="openBackWindow();"><span class="fa fa-eye"></span> Enlarge</button></div>
                </div> 
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

<script>
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
        $('html,body').animate({scrollTop: $("#via" + count).offset().top}, 'slow');
        count++;
    }
</script>

<script>
    var gurl = '';
    
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
        gurl = 'https://www.google.com/maps/embed/v1/directions?key=' + key + '&origin=' + from + '&destination=' + to + '&avoid=tolls|highways';
        code += 'https://www.google.com/maps/embed/v1/directions?key=' + key + '&origin=' + from + '&destination=' + to + '&avoid=tolls|highways';
        if (viaCode != '') {
            code += '&waypoints=' + viaCode;
        }
        code += '"></iframe>';
        var view = document.getElementById('map');
        view.innerHTML = code;
        $('html,body').animate({scrollTop: $("#map").offset().top}, 'slow');
    }
    
    function openBackWindow(){
        if (gurl == '') {
            updateStatus('danger|No route defined');
            return;
        }
        var popupWindow = window.open(gurl,'Route Overview','scrollbars=1,height=768,width=1024');
          if($.browser.msie){
            popupWindow.blur();
            window.focus();
        }else{
           blurPopunder();
        }
      };

    function blurPopunder() {
            var winBlankPopup = window.open("about:blank");
            if (winBlankPopup) {
                winBlankPopup.focus();
                winBlankPopup.close()
            }
    };
</script>
