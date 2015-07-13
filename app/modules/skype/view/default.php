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