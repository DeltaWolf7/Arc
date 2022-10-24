<?php
    if (is_numeric(system\Helper::arcGetLastURIItem())) {
        $user = User::getByID(system\Helper::arcGetLastURIItem());
        if ($user->id == 0) {
            $user = new User();
        }
        $userGroups = UserGroup::getAllGroups();
?>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <span class="badge bg-primary">Created:
                    <?php echo system\Helper::arcConvertDate($user->created); ?></span>&nbsp;
                <span class="badge bg-primary" id="idtag">ID: <?php echo $user->id; ?></span>&nbsp;
            </div>
            <div class="col-md-6 text-end">
                <a class="btn btn-danger" href="<?php echo system\Helper::arcGetProcessor(); ?>"><i
                        class="fas fa-times"></i>
                    Close</a>
            </div>
        </div>
        <form id="userForm">
            <input type="hidden" name="id" id="id" value="<?php echo $user->id; ?>" />
            <div class="row mt-3">
                <div class="col-md-6">

                    <label for="firstname" class="form-label">Firstname</label>
                    <input type="text" class="form-control" name="firstname" placeholder="Firstname"
                        value="<?php echo $user->firstname; ?>">

                    <label for="lastname" class="form-label">Lastname</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Lastname"
                        value="<?php echo $user->lastname; ?>">

                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email"
                        value="<?php echo $user->email; ?>">

                    <label for="avGroups" class="form-label">Available Groups</label>
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
                <div class=" col-md-6">

                            <label for="password" class="form-label">Password (Leave blank to keep unchanged)</label>
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                autocomplete="off">

                            <label for="retype" class="form-label">Retype</label>
                            <input type="password" class="form-control" name="retype" placeholder="Retype"
                                autocomplete="off">

                            <label for="enabled" class="form-label">Account Enabled</label>
                            <select name="enabled" class="form-select">
                                <option value="1" <?php if ($user->enabled == "1") echo "selected"; ?>>Yes
                                </option>
                                <option value="0" <?php if($user->enabled == "0") echo "selected"; ?>>No
                                </option>
                            </select>

                            <label for="inGroups" class="form-label">In Groups</label>
                            <select id="inGroups" class="form-control" size="5"
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input" id="clearImage" name="clearImage"
                            class="form-label">
                        <label class="form-check-label" for="clearImage">Reset User Profile Image?</label>
                    </div>
                </div>
                <div class="col-md-6 text-end mt-3">
                    <button class="btn btn-success" type="submit"><i class="far fa-save"></i>
                        Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
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
            <div class="col-md-6">
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
            <div class="col-md-3">
                <select class="form-select" id="group" onchange="viewGroup()">
                    <option value="0" <?php if(!isset($_GET["groupid"])) { echo "selected"; } ?>>View Group Users
                    </option>
                    <?php
                        $groups = UserGroup::getAllGroups();
                        foreach ($groups as $group) {
                            echo "<option value=\"{$group->id}\"";
                            if (isset($_GET["groupid"]) && $_GET["groupid"] == $group->id) { echo " selected"; }
                            echo ">{$group->name}</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-3 mt-1 text-right"><a href="#" class="btn btn-secondary btn-sm"
                    onclick="exportUsers()"><i class="fas fa-download"></i> Export</a>
                &nbsp;<button class="btn btn-success btn-sm" onclick="arcRedirect('/0')"><i class="fas fa-plus"></i> New
                    User</button></div>
        </div>
        <table class="table table-striped align-middle">
            <thead class="text-primary">
                <th>#</th>
                <th>Img</th>
                <th>Name (<?php echo count($users); ?>)</th>
                <th>Active</th>
                <th>Email</th>
                <th>Last Seen</th>
                <th>Auth</th>
                <th style="width: 150px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
    foreach ($users as $user) {
    ?>
                <tr>
                    <td class="text-center"><?php echo $user->id; ?></td>
                    <td>
                        <?php
                        $profileImage = $user->getProfileImage();
                    ?>
                        <img class="img-fluid" width="30px" src="<?php echo $profileImage; ?>" />
                    </td>
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
                    <td><?php $lastSeen = SystemSetting::getByKey("ARC_USER_LASTSEEN", $user->id); echo $lastSeen->value; ?></td>
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
                    <td>
                     
                            <button class="btn btn-secondary btn-sm"
                                onclick="impersonateUser('<?php echo $user->id; ?>')"><i
                                    class="fas fa-user-secret"></i></button>
                            <a class="btn btn-primary btn-sm"
                                href="<?php echo "/" . system\Helper::arcGetURI() . "/" . $user->id; ?>" target="_blank"><i
                                    class="fa fa-pencil"></i></a>
                            <button style="width: 35px;" class="btn btn-danger btn-sm"
                                onclick="removeUser('<?php echo $user->id; ?>')"><i class="fa fa-remove"></i></button>
                       
                    </td>
                </tr>
                <?php
    }
    ?>
        </table>
    </div>
</div>
<?php
    }
?>