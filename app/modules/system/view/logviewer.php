<?php
$days = SystemSetting::getByKey("ARC_KEEP_LOGS");
?>


<div class="row">
    <div class="col-md-10 text-danger">
        Logs are purged automatically after <?php echo $days->value; ?> days. This can be adjusted in settings.
    </div>
    <div class="col-md-2 text-right">
        <a class="btn btn-primary btn-xs" onclick="clearLogs();"><i class="fa fa-recycle"></i> Purge</a>
    </div>
</div>


<div class="table-responsive">
    <table class="table table-hover table-condensed" id="logs">     
    </table>
</div>
