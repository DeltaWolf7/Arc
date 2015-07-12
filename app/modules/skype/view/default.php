<div class="page-header">
    <h1>Book Skype Session</h1>
</div>



<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id='datetimepicker'>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker({
            defaultDate: moment().valueOf(),
            format: "DD MM YYYY HH mm",
            minDate: moment().valueOf(),
            maxDate: <?php 
                $ahead = SystemSetting::getByKey("SKYPE_BOOK_AHEAD");
                $date = new Datetime("NOW");
                $date->modify("+" . $ahead->value . " day");
                echo $date->format("d/m/Y");
                ?>,
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
                        $disabled .= $date->format("d/m/Y")  . PHP_EOL;
                        echo $disabled;
                    }
                ?>
            ],
            daysOfWeekDisabled: [<?php echo SystemSetting::getByKey("SKYPE_DISABLE_DAYS")->value; ?>],
            inline: true,
            sideBySide: true
        });
    });
</script>