<?php
$days = SystemSetting::getByKey("ARC_KEEP_LOGS");
?>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#log"> Arc Logs</a></li>
    <li><a data-toggle="tab" href="#php"> PHP Logs</a></li>
</ul>

<div class="tab-content">
    <div id="log" class="tab-pane fade in active">
        <div class="alert alert-warning">
            <i class="fa fa-exclamation"></i> Logs are purged automatically after <?php echo $days->value; ?> days. This can be adjusted in settings.
        </div>
        <div id="logs" class="small">
        </div>
    </div>
    <div id="php" class="tab-pane fade">
        <p class="small">
            <?php
            $path = system\Helper::arcGetPath(true) . ini_get('error_log');
            if (file_exists($path)) {
                $log = nl2br(file_get_contents($path));
                $log = str_replace("[", "<mark>[", $log);
                $log = str_replace("]", "]</mark>", $log);
                $log = str_replace("PHP Warning:", "<label class=\"label label-warning\">Warning</label><br />", $log);
                $log = str_replace("PHP Fatal error:", "<label class=\"label label-danger\">Error</label><br />", $log);
                $log = str_replace("PHP Notice:", "<label class=\"label label-default\">Notice</label><br />", $log);
                echo $log;
            } else {
                echo "PHP error log not found or empty.";
            }
            ?>
        </p>
    </div>
</div>

<div class="text-right"><a class="btn btn-primary" onclick="clearLogs();"><i class="fa fa-recycle"></i> Purge Logs</a></div>
