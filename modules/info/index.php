<div class="page-header">
    <h1>System Information</h1>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">System Information</h3>
    </div>
    <div class="panel-body">
        <span class="fa fa-cog"></span>&nbsp;Debug: 
        <?php
        if (ARCDEBUG) {
            echo 'Enabled';
        } else {
            echo 'Disabled';
        }
        ?><br />
        <span class="fa fa-info"></span>&nbsp;
        Arc Version: <?php echo ARCVERSION; ?><br /><br />
        <span class="fa fa-folder-open"></span>&nbsp;
        File System Path: <?php echo arcGetPath(true); ?><br />
        <span class="fa fa-folder-open"></span>&nbsp;
        Web Path: <?php echo 'http://' . $_SERVER['HTTP_HOST'] . ARCWWW; ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">This Module Information</h3>
    </div>
    <div class="panel-body">
        <span class="fa fa-folder-open"></span>&nbsp;
        File Path: <?php echo arcGetModulePath(true); ?><br />
        <span class="fa fa-folder-open"></span>&nbsp;  
        Web Path: <?php echo arcGetModulePath(); ?>
        <br />
        <span class="fa fa-folder-open"></span>&nbsp;  
        Dispatch Path: <?php echo arcGetDispatch(); ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Installed Modules</h3>
    </div>
    <div class="panel-body">
        <ul class="list-group">
            <?php
            $mods = arcGetModules();
            foreach ($mods as $mod) {
                echo '<li class="list-group-item"><span class="fa fa-th-list"></span>&nbsp;' . $mod['name'] . ' (' . $mod['module'] . '), Version: ' . $mod['version'] . ', Author: ' . $mod['author'] . '</li>';
            }
            ?>
        </ul>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Security Information</h3>
    </div>
    <div class="panel-body">

        <?php
        $user = arcGetUser();
        if (!empty($user)) {
            $group = $user->getGroup();
            $permissions = $group->getPermissions();
            echo '<span class="fa fa-group"></span>&nbsp;User Group: ' . $group->name . '<br /><br />';

            echo '<span class="fa fa-user"></span>&nbsp;Permissions:<br />';
            foreach ($permissions as $permission) {
                echo '<span class="fa fa-lock"></span>&nbsp;' . $permission->permission . '<br />';
            }
        }
        ?>
    </div>
</div>

