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
                case "info":
                    echo "<i class=\"fa fa-info\"></i>";
                    break;
                case "danger":
                    echo "<i class=\"fa fa-danger\"></i>";
                    break;
                case "warning":
                    echo "<i class=\"fa fa-warning\"></i>";
                    break;
            }
            echo "</td><td>{$log->module}</td><td>{$log->when}</td><td>{$log->message}</td></tr>";
        }
        ?>
    </table>
</div>