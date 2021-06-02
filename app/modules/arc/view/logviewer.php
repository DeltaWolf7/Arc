<?php
$days = SystemSetting::getByKey("ARC_KEEP_LOGS");
?>


<div class="alert alert-warning">
    <i class="fa fa-exclamation"></i> Logs are purged automatically after <?php echo $days->value; ?> days. This
    can be adjusted in settings.
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <select class="form-select" onchange="userSelect()" id="userS">
                    <option value="0">- User Not Selected -</option>
                    <?php
                        $users = User::getAllUsers();
                        foreach ($users as $user) {
                            echo "<option value=\"{$user->id}\">" . $user->getFullname() . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-7">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" placeholder="Search.."
                        aria-describedby="button-addon2" />
                    <button class="btn btn-outline-secondary" type="button" onclick="searchLogs()"><i
                            class="fas fa-search"></i></button>
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" onclick="clearLogs();"><i class="fa fa-recycle"></i> Purge Logs</button>
            </div>
        </div>
        <div id="logs">
        </div>
    </div>
</div>