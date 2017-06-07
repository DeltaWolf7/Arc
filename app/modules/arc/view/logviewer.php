<?php
$days = SystemSetting::getByKey("ARC_KEEP_LOGS");
?>

<div class="card">
    <div class="card-block">
        <ul class="nav nav-tabs">
            <li class="nav-item"><a data-toggle="tab" href="#log" class="nav-link active"> Arc Logs</a></li>
            <li class="nav-item"><a data-toggle="tab" href="#php" class="nav-link"> PHP Logs</a></li>
        </ul>

        <div class="tab-content">
            <div id="log" class="tab-pane active">
                <div class="alert alert-warning">
                    <i class="fa fa-exclamation"></i> Logs are purged automatically after <?php echo $days->value; ?> days. This can be adjusted in settings.
                </div>
                <div id="logs">
                </div>
            </div>
            <div id="php" class="tab-pane fade">
                <p class="small">
                    <?php
                    $path = system\Helper::arcGetPath(true) . ini_get('error_log');
                    if (!empty(ini_get('error_log')) && file_exists($path)) {
                        $log = nl2br(file_get_contents($path));
                        $log = str_replace("[", "<mark>[", $log);
                        $log = str_replace("]", "]</mark>", $log);
                        $log = str_replace("PHP Warning:", "<i class=\"badge badge-warning\">Warning</i><br />", $log);
                        $log = str_replace("PHP Fatal error:", "<i class=\"badge badge-danger\">Error</i><br />", $log);
                        $log = str_replace("PHP Notice:", "<i class=\"badge badge-default\">Notice</i><br />", $log);
                        echo $log;
                    } else {
                        echo "<div class=\"alert alert-warning\">PHP error log not found or empty.</div>";
                    }
                    ?>
                </p>
            </div>
        </div>

        <div class="text-right"><button class="btn btn-primary" onclick="clearLogs();"><i class="fa fa-recycle"></i> Purge Logs</button></div>
    </div>
</div>