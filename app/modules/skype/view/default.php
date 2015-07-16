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

<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Confirmed Sessions</h3>
                    <?php
                    $confirmed = Skype::getByUserIDAndStatus(system\Helper::arcGetUser()->id, 1);
                    if (count($confirmed) > 0) {
                        echo "<table class=\"table table-condensed\">"
                        . "<thead>"
                        . "<tr><td>Date</td><td>Time</td></tr>"
                        . "</thead>"
                        . "<tbody>";
                        foreach ($confirmed as $item) {
                            echo "<tr><td>{$item->date}</td><td>{$item->time}</td></tr>";
                        }
                        echo "</tbody>"
                        . "</table>";
                    } else {
                        echo "No confirmed sessions.";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Unconfirmed Sessions</h3>
                    <?php
                    $unconfirmed = Skype::getByUserIDAndStatus(system\Helper::arcGetUser()->id, 0);
                    if (count($unconfirmed) > 0) {
                        echo "<table class=\"table table-condensed\">"
                        . "<thead>"
                        . "<tr><td>Date</td><td>Time</td></tr>"
                        . "</thead>"
                        . "<tbody>";
                        foreach ($unconfirmed as $item) {
                            echo "<tr><td>{$item->date}</td><td>{$item->time}</td></tr>";
                        }
                        echo "</tbody>"
                        . "</table>";
                    } else {
                        echo "No unconfirmed sessions.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
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
</script>