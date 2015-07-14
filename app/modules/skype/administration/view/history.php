<div class="page-header">
    <h1>Skype Booking History</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="calendar"></div>
                <br />
                <div class="row">
                    <div class="col-md-6">
                <div>
                    <a class="btn btn-default btn-xs" href="<?php echo system\Helper::arcGetModulePath() . "manage"; ?>">View Current</a>
                </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-right">
                    Key: <a class="btn btn-info btn-xs">Complete</a> <a class="btn btn-warning btn-xs">Cancelled</a>
                </div>
                    </div>
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
    if ($session->status != 1 && $session->status != 0) {
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