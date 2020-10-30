<?php
$days = SystemSetting::getByKey("ARC_KEEP_LOGS");
?>

<ul class="nav nav-tabs">
    <li class="nav-item"><a data-toggle="tab" href="#log" class="nav-link active"> Arc Logs</a></li>
    <li class="nav-item"><a data-toggle="tab" href="#php" class="nav-link"> PHP Logs</a></li>
</ul>

<div class="tab-content">
    <div id="log" class="tab-pane active">
        <div class="alert alert-warning">
            <i class="fa fa-exclamation"></i> Logs are purged automatically after <?php echo $days->value; ?> days. This
            can be adjusted in settings.
        </div>
        <div class="row">
            <div class="col-md-3">
                <select class="form-control" onchange="userSelect()" id="userS">
                    <option value="0">- User Not Selected -</option>
                    <?php
                        $users = User::getAllUsers();
                        foreach ($users as $user) {
                            echo "<option value=\"{$user->id}\">" . $user->getFullname() . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-9">
            <div class="input-group mb-3">
                <input class="form-control" id="search" placeholder="Search.." aria-describedby="basic-addon2" />
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" onclick="searchLogs()"><i class="fas fa-search"></i></button>
                </div>
            </div>
            </div>
        </div>
        <div id="logs">
        </div>
    </div>
    <div id="php" class="tab-pane">
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

<div class="text-right mt-2"><button class="btn btn-primary" onclick="clearLogs();"><i class="fa fa-recycle"></i> Purge
        Logs</button></div>