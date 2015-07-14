<div class="page-header">
    <h1>Skype Booking Manager</h1>
</div>

<?php
$date = new Datetime("NOW");
?>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Today's Sessions</h3>
                <table class="table table-striped">
                    <tbody id="todayData">
                        <?php
                        $today = Skype::getByDateAndStatus($date->format("Y/m/d"), 1);
                        foreach ($today as $session) {
                            $user = new user();
                            $user->getById($session->userid);
                            echo "<tr class=\"";
                            if ($session->time < $date->format("hh:MM")) {
                                echo "active";
                            } else {
                                echo "success";
                            }
                            echo "\"><td>{$session->time}</td><td>{$user->getFullname()}</td><td><a class=\"btn btn-xs\" onclick=\"manage({$session->id})\"><i class=\"fa fa-wrench\"></i></a></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Tomorrow's Sessions</h3>
                <table class="table table-striped">
                    <tbody id="todayData">
                        <?php
                        $tomorrowDate = $date->modify("+1 day");
                        $tomorrow = Skype::getByDateAndStatus($tomorrowDate->format("Y/m/d"), 1);
                        foreach ($tomorrow as $session) {
                            $user = new user();
                            $user->getById($session->userid);
                            echo "<tr class=\"";
                            if ($session->time < $date->format("hh:MM")) {
                                echo "active";
                            } else {
                                echo "success";
                            }
                            echo "\"><td>{$session->time}</td><td>{$user->getFullname()}</td><td><a class=\"btn btn-xs\" onclick=\"manage({$session->id})\"><i class=\"fa fa-wrench\"></i></a></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="calendar"></div>
                <br />
                <div class="text-right">
                    Key: <a class="btn btn-info btn-xs">Complete</a> <a class="btn btn-danger btn-xs">Unconfirmed</a> <a class="btn btn-success btn-xs">Confirmed</a> <a class="btn btn-warning btn-xs">Cancelled</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="status"></div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Booking Information</h4>
            </div>
            <div class="modal-body" id="eventData">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savebtn">Save</button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            duration: "<?php
                        $length = SystemSetting::getByKey("SKYPE_SESSION_LENGTH")->value;
                        echo $length;
                        ?>",
            events: [
<?php
$sessions = Skype::getAllBookings();
$events = "";
foreach ($sessions as $session) {
    $user = new User();
    $user->getByID($session->userid);
    $time = strtotime($session->time);
    $end = $session->date . "T" . date("H:i", strtotime('+' . $length . ' minutes', $time));
    $events .= "{id: '" . $session->id . "', title: '" . $user->getFullname() . "', start: '" . $session->date . "T" . $session->time . "', end: '" . $end . "', className: 'btn btn-";
    if ($session->status == 0) {
        $events .= "danger";
    } elseif ($session->status == 1) {
        $events .= "success";
    } elseif ($session->status == 2) {
        $events .= "info";
    } else {
        $events .= "warning";
    }
    $events .= "', overlap: false},";
}
$events = rtrim($events, ",");
echo $events;
?>
            ],
            eventClick: function (calEvent, jsEvent, view) {
                manage(calEvent.id);
            }
        })

    });

    var editid = 0;
    function manage(id) {
        editid = id;
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "manage", id: id},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $('#eventData').html(jdata.html);
                $('#myModal').modal('show');
            }
        });

    }
    
    $("#savebtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "savesession", statusid: $("#statusid").val(), notes: $("#notes").val(), id: editid},
            complete: function (data) {
                updateStatus("status", null);
                $('#myModal').modal('hide');
                location.reload();
            }
        });

    });
</script>