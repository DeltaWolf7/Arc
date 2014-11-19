<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-plus fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">Bookings</div>
                        <div>Take and view bookings</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo arcGetModulePath(); ?>bookings">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-bus fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">Vehicles</div>
                        <div>Manage vehicles</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo arcGetModulePath(); ?>vehicles">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">Drivers</div>
                        <div>Manage drivers</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo arcGetModulePath(); ?>drivers">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">Customers</div>
                        <div>Manage customer records</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo arcGetModulePath(); ?>customers">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->


<div class="panel panel-default">
    <!-- Responsive calendar - START -->
    <div class="responsive-calendar">
        <div class="controls">
            <a class="pull-left" data-go="prev"><div class="btn"><i class="fa fa-chevron-left"></i> Previous</div></a>
            <h4><span data-head-year></span> <span data-head-month></span></h4>
            <a class="pull-right" data-go="next"><div class="btn">Next <i class="fa fa-chevron-right"></i></div></a>
        </div><hr/>
        <div class="day-headers">
            <div class="day header">Mon</div>
            <div class="day header">Tue</div>
            <div class="day header">Wed</div>
            <div class="day header">Thu</div>
            <div class="day header">Fri</div>
            <div class="day header">Sat</div>
            <div class="day header">Sun</div>
        </div>
        <div class="days" data-group="days">
            <!-- the place where days will be generated -->
        </div>
    </div>
</div>
<!-- Responsive calendar - END -->
<!--http://w3widgets.com/responsive-calendar//-->

<script>
    $(document).ready(function () {
        $('.responsive-calendar').responsiveCalendar();
    });

    $(document).ready(function () {
        $('.responsive-calendar').responsiveCalendar('edit', {
<?php
$bookings = Booking::getBookingsByMonth(date("m"));
$string = "";
foreach ($bookings as $booking) {
    $string .= "\"" . $booking->journeydate . "\": {\"number\": \"Ref: " . $booking->reference . "<br />Arrival: " . $booking->arrivaltime . "<br />Depart: " . $booking->departuretime . "\", \"badgeClass\": \"badge-green\", \"url\": \"" . arcGetModulePath() . "bookings/edit/" . $booking->id . "\"}," . PHP_EOL;
    $string .= "\"" . $booking->returndate . "\": {\"number\": \"Ref: " . $booking->reference . "<br />Return: " . $booking->returntime . "\", \"badgeClass\": \"badge-yellow\", \"url\": \"" . arcGetModulePath() . "bookings/edit/" . $booking->id . "\"}," . PHP_EOL;
}
echo $string;
?>
        })
    });
</script>