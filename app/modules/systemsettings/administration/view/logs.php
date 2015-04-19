<div class="page-header">
    <h1>System Logs</h1>
</div>

<div class="table-responsive">
    <table class="table table-hover table-condensed">
        <tr><th>Type</th><th>Module</th><th>When</th><th>Message</th></tr>
        <?php
        $logs = Log::getLogs();
        foreach ($logs as $log) {
            echo "<tr><td>";
            switch ($log->type) {
                case "success":
                    echo "<span class=\"label label-success\"><i class=\"fa fa-check\"></i> Success<span>";
                    break;
                case "info":
                    echo "<span class=\"label label-info\"><i class=\"fa fa-info-circle\"></i> Info<span>";
                    break;
                case "danger":
                    echo "<span class=\"label label-danger\"><i class=\"fa fa-exclamation-circle\"></i> Error<span>";
                    break;
                case "warning":
                    echo "<span class=\"label label-warning\"><i class=\"fa fa-exclamation-triangle\"></i> Warning<span>";
                    break;
            }
            echo "</td><td>{$log->module}</td><td>{$log->when}</td><td>{$log->message}</td></tr>";
        }
        ?>
    </table>
</div>