<?php
$days = SystemSetting::getByKey("ARC_KEEP_LOGS");
?>


<div class="row">
    <div class="col-md-10">
        <div class="alert alert-warning">Logs are purged automatically after <?php echo $days->value; ?> days. This can be adjusted in settings.</div>
    </div>
    <div class="col-md-2 text-right">
        <a class="btn btn-primary" onclick="clearLogs();" data-toggle="tooltip" data-placement="bottom" title="Clear system logs"><i class="fa fa-recycle"></i></a>
    </div>
</div>


<div class="table-responsive">
    <table class="table table-hover table-condensed" id="logs">     
    </table>
</div>
