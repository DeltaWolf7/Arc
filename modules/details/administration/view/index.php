<div class="page-header">
    <h1>User Management
        <?php
        if (!empty(arcGetURLData("data3"))) {
            echo "<a href='" . arcGetModulePath() . "'><span class='fa fa-arrow-circle-left'></span></a>";
        }
        ?>
    </h1>
</div>


<p>
<ul class="nav nav-pills" role="tablist">
    <li<?php
    if (empty(arcGetURLData("data2")) || arcGetURLData("data2") == "user") {
        echo " class=\"active\"";
    }
    ?>><a href="<?php echo arcGetModulePath() . "user" ?>"><span class="fa fa-users"></span> Users</a></li>
    <li<?php
    if (arcGetURLData("data2") == "group") {
        echo " class=\"active\"";
    }
    ?>><a href="<?php echo arcGetModulePath() . "group" ?>"><span class="fa fa-group"></span> Groups</a></li>
    <li<?php
    if (arcGetURLData("data2") == "access") {
        echo " class=\"active\"";
    }
    ?>><a href="<?php echo arcGetModulePath() . "access/1" ?>"><span class="fa fa-file-text"></span> Access Logs</a></li>
</ul>
</p> 


<?php
if (empty(arcGetURLData("data3")) || arcGetURLData("data2") == "access" || arcGetURLData("data2") == "ip") {
    ?>
    <div class="tab-content">
        <div class="tab-pane active">
            <div class="panel panel-default">
                <div class="panel-body">  
                    <?php
                    if (empty(arcGetURLData("data2")) || arcGetURLData("data2") == "user") {
                        ?>

                        <table class="table table-striped">
                            <tr><th>ID</th><th>Firstname</th><th>Lastname</th><th>Email</th><th class="text-right"><button type="button" class="btn btn-primary btn-sm" onclick="window.location = '<?php echo arcGetModulePath() . "user/edit/0"; ?>'"><span class="fa fa-plus"></span> New User</button></th></tr>
                            <?php
                            $users = User::getAllUsers();
                            foreach ($users as $user) {
                                echo "<tr><td>" . $user->id . "</td><td>" . $user->firstname . "</td><td>" . $user->lastname . "</td>" .
                                "<td>" . $user->email . "</td>" .
                                "<td class='text-right'><button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"window.location='" . arcGetModulePath() . "user/edit/" . $user->id . "'\"><span class=\"fa fa-edit\"></span> Edit</button>" .
                                "&nbsp;<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"window.location='" . arcGetModulePath() . "user/remove/" . $user->id . "'\"><span class='fa fa-remove'></span> Remove</button></td></tr>";
                            }
                            ?>
                        </table>

                    <?php } elseif (arcGetURLData("data2") == "group") { ?>

                        <table class="table table-striped">
                            <tr><th>ID</th><th>Name</th><th>Description</th><th class="text-right"><button class="btn btn-primary btn-sm" onclick="window.location = '<?php echo arcGetModulePath() . "group/edit/0"; ?>'"><span class="fa fa-plus"></span> New Group</button></th></tr>
                            <?php
                            $groups = UserGroup::getAllGroups();
                            foreach ($groups as $group) {
                                echo "<tr><td>" . $group->id . "</td><td>" . $group->name . "</td><td>" . $group->description . "</td>" .
                                "<td class='text-right'><button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"window.location='" . arcGetModulePath() . "group/edit/" . $group->id . "'\"><span class=\"fa fa-cog\"></span> Permissions</button>";
                                if ($group->id != 1 && $group->id != 2 && $group->id != 3) {
                                    echo "&nbsp;<button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"window.location='" . arcGetModulePath() . "group/delete/" . $group->id . "'\"><span class=\"fa fa-remove\"></span> Remove</button></td></tr>";
                                }
                            }
                            ?>
                        </table>

                    <?php } elseif (arcGetURLData("data2") == "access" || arcGetURLData("data2") == "ip") { ?>

                        <table class="table table-striped">
                            <tr><th>User</th><th>When</th><th>Browser</th><th>IP Address</th><th>Url</th><th>Referer</th></tr>
                            <?php
                            if (arcGetURLData("data2") == "access") {
                                $logs = LastAccess::getLogs();
                                $page = ((int) arcGetURLData("data3"));
                                $mark = 15;
                            } else {
                                $logs = LastAccess::getLogsByIP(arcGetURLData("data3"));
                                $page = 1;
                                $mark = count($logs);
                            }
                            $length = $mark * $page;
                            for ($i = $length - $mark; $i < $length; $i++) {
                                $user = new User();
                                if (isset($logs[$i]->userid)) {
                                    $user->getByID($logs[$i]->userid);
                                }

                                // dirty hack until a better method is created
                                if (isset($logs[$i])) {
                                    echo "<tr><td>";
                                    if ($user->id == "0") {
                                        echo "Anonymous";
                                    } else {
                                        echo "<a href=\"" . arcGetModulePath() . "user/edit/" . $user->id . "\">" . $user->firstname . " " . $user->lastname . "</a>";
                                    }

                                    echo "</td><td>" . $logs[$i]->when . "</td><td>" . $logs[$i]->browser . "</td><td><a href=\"" . arcGetModulePath() . "ip/" . $logs[$i]->ipaddress . "\">" . $logs[$i]->ipaddress . "</a></td><td>" . $logs[$i]->url . "</td><td>" . $logs[$i]->referer . "</td></tr>";
                                }
                            }
                            ?>
                        </table>
                        <ul class="pagination">
                            <?php
                            for ($i = 1; $i <= count($logs) / $mark; $i++) {
                                echo "<li";
                                if (arcGetURLData("data3") == $i) {
                                    echo " class=\"active\"";
                                }
                                echo "><a href=\"" . arcGetModulePath() . "access/" . $i . "\">" . $i . "</a></li>";
                            }
                            ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>





<?php
if (arcGetURLData("data2") == "user") {
    if (arcGetURLData("data3") == "edit") {
        $user = new User();
        if (arcGetURLData("data4") != "0") {
            $user->getByID(arcGetURLData("data4"));
        }
        ?>
        <form role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">User Details</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input type="text" class="form-control" id="firstname" placeholder="Firstname" value="<?php echo $user->firstname; ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Lastname</label>
                                <input type="text" class="form-control" id="lastname" placeholder="Lastname" value="<?php echo $user->lastname; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Email" value="<?php echo $user->email; ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="retype">Retype</label>
                                <input type="password" class="form-control" id="retype" placeholder="Retype" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">User Group</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="retype">Group</label>
                                <select id="group" class='form-control'>
                                    <?php
                                    $groups = UserGroup::getAllGroups();
                                    foreach ($groups as $group) {
                                        echo "<option value='" . $group->id . "'";
                                        if ($user->usergroupid == $group->id) {
                                            echo " selected";
                                        }
                                        echo ">" . $group->name . "</option>" . PHP_EOL;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (arcGetURLData("data4") != "0") {
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">IP Addresses</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <ul class="list-unstyled">
                                        <?php
                                        $ips = LastAccess::getIPsByUserID($user->id);
                                        foreach ($ips as $ip) {
                                            echo "<li class=\"list-group-item\">" . $ip->ipaddress;
                                            if ($_SERVER["REMOTE_ADDR"] == $ip->ipaddress) {
                                                echo "<span class=\"badge\"><span class=\"fa fa-check-square\"></span> Current IP</span>";
                                            }
                                            echo "</li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div></div>
            <div class="text-right">
                <input type="hidden" id="userid" value="<?php echo $user->id; ?>" />
                <button type="button" class="btn btn-success" onclick="ajax.send('POST', {action: 'saveuser', userid: '#userid', firstname: '#firstname', lastname: '#lastname', password: '#password', retype: '#retype', email: '#email', group: '#group'}, '<?php arcGetDispatch(); ?>', updateStatus, true);"><span class="fa fa-save"></span> Save</button>
            </div>
        </form>
        <?php
    } elseif (arcGetURLData("data3") == "remove") {
        $user = new User();
        $user->getByID(arcGetURLData("data4"));
        $user->delete($user->id);
        echo "<script>window.location = '" . arcGetModulePath() . "';</script>";
    }
} elseif (arcGetURLData("data2") == "group") {
    $group = new UserGroup();
    $group->getByID(arcGetURLData("data4"));
    if (arcGetURLData("data3") == "edit") {
        ?>

        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Group</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="groupname">Group Name</label>
                            <input maxlength="100" type="text" class="form-control" id="groupname" placeholder="Group name" value="<?php echo $group->name; ?>">
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="groupname">Group Description</label>
                                <input maxlength="100" type="text" class="form-control" id="groupdescription" placeholder="Group description" value="<?php echo $group->description; ?>">
                            </div>
                        </div>
                    </div>
                </div></div>
            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Group Permissions</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tr><th>Permission</th><th class="text-right"><button type="button" class="btn btn-primary btn-sm" onclick="window.location = '<?php echo arcGetModulePath() . "group/add/" . arcGetURLData("data4"); ?>'"><span class="fa fa-plus"></span> New Permission</button></th></tr>
                            <?php
                            $permissions = $group->getPermissions();
                            $count = 0;

                            foreach ($permissions as $permission) {
                                echo "<tr><td><select id='permission" . $count . "' class='form-control'>";
                                echo "<option";
                                if ($permission->permission == "none") {
                                    echo " selected";
                                }
                                echo ">none</option>";
                                $pages = Page::getAllPages();
                                //hack to fix permissions not working
                                //for page/administration
                                echo "<option";
                                if ($permission->permission == "page/administration") {
                                    echo " selected";
                                }
                                echo ">page/administration</option>";

                                foreach ($pages as $page) {
                                    echo "<option";
                                    $perm = "page/" . $page->seourl;
                                    if ($permission->permission == $perm) {
                                        echo " selected";
                                    }
                                    echo ">" . $perm . "</option>";
                                }
                                $modules = arcGetModules();
                                foreach ($modules as $module) {
                                    echo "<option";
                                    $perm = "module/" . $module["module"];
                                    if ($permission->permission == $perm) {
                                        echo " selected";
                                    }
                                    echo ">" . $perm . "</option>";
                                }
                                echo "</select></td><td class='text-right'><button type=\"button\" class=\"btn btn-default btn-sm\" onclick=\"window.location='" . arcGetModulePath() . "group/remove/" . $permission->id . "/" . $group->id . "'\"><span class='fa fa-remove'></span> Remove</button>";
                                ?>
                                <button type="button" class="btn btn-default btn-sm" onclick="ajax.send('POST', {action: 'savepermission', id: '<?php echo $permission->id; ?>', data: '#<?php echo 'permission' . $count; ?>'}, '<?php arcGetDispatch(); ?>', updateStatus, true);"><span class="fa fa-save"></span> Save</button>
                                <?php
                                echo "</td></tr>";
                                $count++;
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right">      
            <?php if ($group->id != 1 && $group->id != 2 && $group->id != 3) { ?>
                <button type="button" class="btn btn-success" onclick="ajax.send('POST', {action: 'savegroup', id: '<?php echo $group->id; ?>', name: '#groupname', description: '#groupdescription'}, '<?php arcGetDispatch(); ?>', updateStatus, true);">Save</button>
            <?php } ?>         
        </div>
        <?php
    } elseif (arcGetURLData("data3") == "add") {
        $permission = new UserPermission();
        $permission->groupid = $group->id;
        $permission->permission = "none";
        $permission->update();
        echo "<script>window.location = '" . arcGetModulePath() . "group/edit/" . $group->id . "';</script>";
    } elseif (arcGetURLData("data3") == "delete") {
        $group = new UserGroup();
        $group->delete(arcGetURLData("data4"));
        echo "<script>window.location = '" . arcGetModulePath() . "group';</script>";
    } elseif (arcGetURLData("data3") == "remove") {
        $permission = new UserPermission();
        $permission->getByID(arcGetURLData("data4"));
        $permission->delete($permission->id);
        echo "<script>window.location = '" . arcGetModulePath() . "group/edit/" . arcGetURLData("data5") . "';</script>";
    }
}
?>