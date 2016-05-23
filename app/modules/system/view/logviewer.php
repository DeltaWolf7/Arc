<?php
$days = SystemSetting::getByKey("ARC_KEEP_LOGS");
?>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#log"><i class="fa fa-exclamation-circle"></i> Arc Logs</a></li>
    <li><a data-toggle="tab" href="#php"><i class="fa fa-file-text-o"></i> PHP Logs</a></li>
</ul>

<div class="tab-content small">
    <div id="log" class="tab-pane fade in active">
        <div class="row">
            <div class="col-md-10 text-danger">
                Logs are purged automatically after <?php echo $days->value; ?> days. This can be adjusted in settings.
            </div>
            <div class="col-md-2 text-right">
                <a class="btn btn-primary btn-xs" onclick="clearLogs();"><i class="fa fa-recycle"></i> Purge</a>
            </div>
        </div>

        <div id="logs">
        </div>
    </div>
    <div id="php" class="tab-pane fade">
        <p class="small">
        <?php
        $setting = SystemSetting::getByKey("ARC_PHP_LOG_PATH");    
        $path = $setting->value;
        
        if (file_exists($path)) {
            $log = nl2br(file_get_contents($path));
            $log = str_replace("[", "<mark>[", $log);
            $log = str_replace("]", "]</mark>", $log);
            $log = str_replace("PHP Warning:", "<label class=\"label label-warning\">Warning</label><br />", $log);
            $log = str_replace("PHP Error:", "<label class=\"label label-danger\">Error</label><br />", $log);
            $log = str_replace("PHP Notice:", "<label class=\"label label-default\">Notice</label><br />", $log);
            echo $log;
        } else {
            echo "PHP error log not found.";
        }
        ?>
    </p>
    </div>
</div>
