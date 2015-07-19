<div class="page-header">
    <h1>Book Skype Session</h1>
</div>



<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <h3>Step 1. Choose a date and time</h3>
                    <div id='datetimepicker'>
                    </div>
                    <?php
                    $sessionLength = SystemSetting::getByKey("SKYPE_SESSION_LENGTH");
                    $notice = SystemSetting::getByKey("SKYPE_DAYS_NOTICE");
                    ?>

                    <div class="alert alert-info">You can book a <?php echo $sessionLength->value; ?> minute session with <?php echo $notice->value; ?> days notice.</div>
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <h3>Step 2. Submit the session request</h3>
                    <p class="text-left">Submitting a request does <strong>NOT</strong> guarantee you will be given the selected date and time. This is subject to approval by administration.</p>
                    <p class="text-left">You will be contacted once the request has been processed.</p>
                    <a id="submit" class="btn btn-default btn-lg">Submit for approval</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="status"></div>

<div id="calendar"></div>
<div class="text-right">
    Key: <a class="btn btn-danger btn-xs">Unconfirmed</a> <a class="btn btn-success btn-xs">Confirmed</a> <a class="btn btn-info btn-xs">Complete</a> <a class="btn btn-warning btn-xs">Cancelled</a>
</div>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker({
            useCurrent: true,
            format: "DD MM YYYY HH mm",
            minDate: moment().valueOf(),
            stepping: <?php echo SystemSetting::getByKey("SKYPE_SESSION_LENGTH")->value; ?>,
            disabledDates: [
<?php
$notice = SystemSetting::getByKey("SKYPE_DAYS_NOTICE");
if (!empty($notice->value)) {
    $disabled = "";
    while ($notice->value > 0) {
        $date = new Datetime("NOW");
        $date->modify("+" . $notice->value . " day");
        $disabled .= $date->format("d/m/Y") . "," . PHP_EOL;
        $notice->value--;
    }
    $date = new Datetime("NOW");
    $disabled .= $date->format("d/m/Y") . PHP_EOL;
    echo $disabled;
}
?>
            ],
            daysOfWeekDisabled: [<?php echo SystemSetting::getByKey("SKYPE_DISABLE_DAYS")->value; ?>],
            inline: true,
            sideBySide: true
        });
    });

    $("#submit").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "submit", id: <?php echo system\Helper::arcGetUser()->id; ?>, date: $('#datetimepicker').data("date")},
            complete: function (data) {
                updateStatus("status");
            }
        });
    });


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
            ]
        })
    });
</script>