<?php
    if (is_numeric(system\Helper::arcGetLastURIItem())) {
        $user = User::getByID(system\Helper::arcGetLastURIItem());
        if ($user->id == 0) {
            $user = new User();
        }
        $userGroups = UserGroup::getAllGroups();
?>
<div class="row">
    <div class="col-md-6">
        <span class="badge badge-info">Created:
            <?php echo system\Helper::arcConvertDate($user->created); ?></span>&nbsp;
        <span class="badge badge-primary">ID: <?php echo $user->id; ?></span>&nbsp;
    </div>
    <div class="col-md-6 text-right">
        <a class="btn btn-danger" href="<?php echo system\Helper::arcGetProcessor(); ?>"><i class="fas fa-times"></i> Close</a>
    </div>
</div>
<form id="userForm">
    <input type="hidden" name="id" value="<?php echo $user->id; ?>" />
    <input type="hidden" name="redirect" value="<?php echo system\Helper::arcGetProcessor(); ?>" />
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input type="text" class="form-control" name="firstname" placeholder="Firstname"
                    value="<?php echo $user->firstname; ?>">
            </div>
            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" class="form-control" name="lastname" placeholder="Lastname"
                    value="<?php echo $user->lastname; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Email"
                    value="<?php echo $user->email; ?>">
            </div>
            <div class="form-group">
                <label for="avGroups">Available Groups</label>
                <select id="avGroups" class="form-control" size="5"
                    ondblclick="addUserToGroup('<?php echo $user->id; ?>')">;
                    <?php
                        foreach ($userGroups as $group) { 
                            if ($user->inGroup($group->name) != true) {
                                ?>
                    <option value="<?php echo $group->name; ?>""><?php echo $group->name; ?></option>
                                <?php
                            }
                        }
    ?>
    
        </select>
                    </div>
                </div>
                <div class=" col-md-6">
                        <div class="form-group">
                            <label for="password">Password (Leave blank to keep unchanged)</label>
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="retype">Retype</label>
                            <input type="password" class="form-control" name="retype" placeholder="Retype"
                                autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="enabled">Account Enabled</label>
                            <select name="enabled" class="form-control">
                                <option value="1" <?php if ($user->enabled == "1") echo "selected"; ?>>Yes</option>
                                <option value="0" <?php if($user->enabled == "0") echo "selected"; ?>>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inGroups">In Groups</label>
                            <select name="inGroups" class="form-control" size="5"
                                ondblclick="removeUserFromGroup('<?php echo $user->id; ?>')">
                                <?php
                        foreach ($userGroups as $group) { 
                            if ($user->inGroup($group->name) == true) {
                                echo "<option value=" . $group->name . ">" . $group->name . "</option>";
                            }
                        }
                        ?>
                            </select>
                        </div>
            </div>
        </div>

        <div class="text-right">
            <button class="btn btn-success" type="submit"><i class="far fa-save"></i>
                Save</button>
        </div>
</form>
<?php
    } else {
        // all users
?>

<div class="card">
    <div class="card-body table-responsive" id="dataTable">
        <?php
    $users = [];
    
    if (isset($_GET["search"]) && $_GET["search"] != "") {
        $users = User::search($_GET["search"]);
    } else if (isset($_GET["groupid"])) {
        $users = UserGroup::getByID($_GET["groupid"])->getUsers();
    } else {
        $users = User::getAllUsers();
    }
    ?>

        <div class="mb-2 row">
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <input class="form-control" id="usearch" placeholder="Search.." aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" onclick="searchUsers()"><i
                                class="fas fa-search"></i></button>
                        <button class="btn btn-outline-secondary" type="button" onclick="arcRedirect()"><i
                                class="fas fa-broom"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-1 text-right"><a href="#" class="btn btn-secondary btn-sm"
                    onclick="exportUsers()"><i class="fas fa-download"></i></a>
                &nbsp;<button class="btn btn-primary btn-sm" onclick="viewGroups()"><i class="fas fa-list"></i>
                    Groups</button>
                &nbsp;<button class="btn btn-success btn-sm" onclick="arcRedirect('/0')"><i class="fas fa-plus"></i> New
                    User</button></div>
        </div>
        <table class="table table-striped">
            <thead>
                <th>#</th>
                <th>Name (<?php echo count($users); ?>)</th>
                <th>Active</th>
                <th>Email</th>
                <th>CRM</th>
                <th>Auth</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
    foreach ($users as $user) {
        $crmuser = CRMUser::getByUserID($user->id);
    ?>
                <tr>
                    <td class="text-center"><?php echo $user->id; ?></td>
                    <td>
                        <?php
        $isAdmin = $user->inGroup("Administrators");
        if ($isAdmin == true) {
    ?>
                        <i class="fas fa-user-shield text-danger"></i>
                        <?php
        }
    ?>
                        <a
                            href="<?php echo "/" . system\Helper::arcGetURI() . "/" . $user->id; ?>"><?php echo $user->getFullname(); ?></a>
                    </td>
                    <td class="text-center">
                        <?php
        if ($user->enabled == true) {
            ?>
                        <button class="btn btn-success btn-sm" onclick="toggleEnable('<?php echo $user->id; ?>')"><i
                                class="fa fa-check"></i></button>
                        <?php
        } else {
            ?>
                        <button class="btn btn-danger btn-sm" onclick="toggleEnable('<?php echo $user->id; ?>')"><i
                                class="fa fa-remove"></i></button>
                        <?php
        }
        ?>
                    </td>
                    <td><?php echo $user->email; ?></td>
                    <td class="text-center">
                        <?php
        if ($crmuser->id == 1) {
            ?>
                        <i class="fas fa-check text-success"></i>
                        <?php
        } else {
            ?>
                        <i class="fas fa-times text-danger"></i>
                        <?php
        }
        ?>
                    </td>
                    <td class="text-center">
                        <?php
        $ad = SystemSetting::getByKey("ARC_USER_AD", $user->id);
        if ($ad->id == 0) {
            ?>
                        <i class="fa fa-user"></i>
                        <?php
        } else {
            ?>
                        <i class="fa fa-cloud-download"></i>
                        <?php
        }
        ?>

                    </td>
                    <td style="width: 10px;">
                        <div class="btn-group" role="group">
                            <button class="btn btn-secondary btn-sm"
                                onclick="impersonateUser('<?php echo $user->id; ?>')"><i
                                    class="fas fa-user-secret"></i></button>
                            <a class="btn btn-primary btn-sm"
                                href="<?php echo "/" . system\Helper::arcGetURI() . "/" . $user->id; ?>"><i
                                    class="fa fa-pencil"></i></a>
                            <button style="width: 35px;" class="btn btn-danger btn-sm"
                                onclick="removeUser('<?php echo $user->id; ?>')"><i class="fa fa-remove"></i></button>
                        </div>
                    </td>
                </tr>
                <?php
    }
    ?>
        </table>
    </div>
</div>

<div class="modal" id="editGroupModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Group</h5>
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i
                        class="sr-only">Close</i></button>
            </div>
            <form id="groupForm">
            <div class="modal-body">
                <input type="hidden" id="groupid" name="groupid" value="0" />
                <div class="form-group">
                    <label for="groupname">Group Name</label>
                    <input maxlength="100" type="text" class="form-control" id="groupname" name="groupname" placeholder="Group name">
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="groupname">Group Description</label>
                        <input maxlength="100" type="text" class="form-control" id="groupdescription"
                        name="groupdescription" placeholder="Group description">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                <button class="btn btn-success" type="submit"><i class="far fa-save"></i> Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php
    }
?>