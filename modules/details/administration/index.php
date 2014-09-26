<div class="page-header">
    <h1>User Management
        <?php
        if (!empty(arcGetURLData("data3"))) {
            echo "<a href='" . arcGetModulePath() . "'><span class='fa fa-arrow-circle-left'></span></a>";
        }
        ?>
    </h1>
</div>

<?php
if (empty(arcGetURLData("data2"))) {
    ?>

    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#users" role="tab" data-toggle="tab">Users</a></li>
        <li><a href="#groups" role="tab" data-toggle="tab">Groups</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="users">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Users</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr><th>ID</th><th>Firstname</th><th>Lastname</th><th>Email</th><th class="text-right"><a href='<?php echo arcGetModulePath() . "user/edit/0"; ?>'><span class="fa fa-plus"></span> New User</a></th></tr>
                        <?php
                        $users = User::getAllUsers();
                        foreach ($users as $user) {
                            echo "<tr><td>" . $user->id . "</td><td>" . $user->firstname . "</td><td>" . $user->lastname . "</td>" .
                            "<td>" . $user->email . "</td>" .
                            "<td class='text-right'><a href='" . arcGetModulePath() . "user/edit/" . $user->id . "'><span class='fa fa-edit'></span> Edit</a>" .
                            "&nbsp;<a href='" . arcGetModulePath() . "user/remove/" . $user->id . "'><span class='fa fa-remove'></span> Remove</a></td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div></div>

        <div class="tab-pane" id="groups">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Groups</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr><th>ID</th><th>Name</th><th>Description</th><th class="text-right"><a href='<?php echo arcGetModulePath() . "group/edit/0"; ?>'><span class="fa fa-plus"></span> New Group</a></th></tr>
                        <?php
                        $groups = UserGroup::getAllGroups();
                        foreach ($groups as $group) {
                            echo "<tr><td>" . $group->id . "</td><td>" . $group->name . "</td><td>" . $group->description . "</td>" .
                            "<td class='text-right'><a href='" . arcGetModulePath() . "group/edit/" . $group->id . "'><span class='fa fa-cog'></span> Permissions</a>";
                            if ($group->id != 1 && $group->id != 2 && $group->id != 3) {
                                echo "&nbsp;<a href='" . arcGetModulePath() . "group/delete/" . $group->id . "'><span class='fa fa-remove'></span> Remove</a></td></tr>";
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div></div>

    <?php
} elseif (arcGetURLData("data2") == "user") {

    if (arcGetURLData("data3") == "edit") {

        $user = new User();
        if (arcGetURLData("data4") != "0") {
            $user->getByID(arcGetURLData("data4"));
        }
        ?>

        <form role="form">
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

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Style</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="theme"><span class="fa fa-exclamation-sign"></span> Theme</label>
                        <select id="theme" class="form-control">
                            <option value="">default</option>
                            <?php
                            $selectedtheme = $user->getSettingByKey("ARC_THEME");
                            $themes = scandir(arcGetPath(true) . "/css/themes/");
                            foreach ($themes as $theme) {
                                if ($theme != ".." && $theme != ".") {
                                    $themename = substr($theme, 0, strlen($theme) - 8);
                                    echo "<option value='" . $themename . "'";
                                    if ($selectedtheme->setting == $themename) {
                                        echo " selected";
                                    }
                                    echo ">" . $themename . "</option>" . PHP_EOL;
                                }
                            }
                            ?>
                        </select>

                    </div>
                </div>
            </div>
            <input type="hidden" id="userid" value="<?php echo $user->id; ?>" />
            <button type="button" class="btn btn-default" onclick="ajax.send('POST', {action: 'saveuser', theme: '#theme', userid: '#userid', firstname: '#firstname', lastname: '#lastname', password: '#password', retype: '#retype', email: '#email', group: '#group'}, '<?php arcGetDispatch(); ?>', updateStatus, true);">Update</button>
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Group Permissions</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-11">
                        <div class="form-group">
                            <label for="groupname">Group Name</label>
                            <input maxlength="100" type="text" class="form-control" id="groupname" placeholder="Group name" value="<?php echo $group->name; ?>">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <br /><br />
                            <?php if ($group->id != 1 && $group->id != 2 && $group->id != 3) { ?>
                                <a href="#" onclick="ajax.send('POST', {action: 'savegroup', id: '<?php echo $group->id; ?>', name: '#groupname', description: '#groupdescription'}, '<?php arcGetDispatch(); ?>', updateStatus, true);"><span class="fa fa-save"></span> Save</a>
                            <?php } ?>
                        </div></div>
                </div>
                <div class="form-group">

                    <div class="form-group">
                        <label for="groupname">Group Description</label>
                        <input maxlength="100" type="text" class="form-control" id="groupdescription" placeholder="Group description" value="<?php echo $group->description; ?>">
                    </div>

                </div>
                <table class="table table-striped">
                    <tr><th>Permission</th><th class="text-right"><a href="<?php echo arcGetModulePath() . "group/add/" . arcGetURLData("data4"); ?>"><span class="fa fa-plus"></span> New Permission</a></th></tr>

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
                        echo "</select></td><td class='text-right'><a href='" . arcGetModulePath() . "group/remove/" . $permission->id . "/" . $group->id . "'><span class='fa fa-remove'></span> Remove</a>";
                        ?>
                        <a href="#" onclick="ajax.send('POST', {action: 'savepermission', id: '<?php echo $permission->id; ?>', data: '#<?php echo 'permission' . $count; ?>'}, '<?php arcGetDispatch(); ?>', updateStatus, true);"><span class="fa fa-save"></span> Save</a>
                        <?php
                        echo "</td></tr>";
                        $count++;
                    }
                    ?>
                </table>
            </div></div>
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
        echo "<script>window.location = '" . arcGetModulePath() . "';</script>";
    } elseif (arcGetURLData("data3") == "remove") {
        $permission = new UserPermission();
        $permission->getByID(arcGetURLData("data4"));
        $permission->delete($permission->id);
        echo "<script>window.location = '" . arcGetModulePath() . "group/edit/" . arcGetURLData("data5") . "';</script>";
    }
}
?>