<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>API Key</th>
                    <th>Secret</th>
                    <th class="text-end"><button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create</button></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select class="form-select" id="userid">
                            <?php 
                                $users = User::getAllUsers();
                                foreach ($users as $user) {
                                    echo "<option value=\"$user->id\">" . $user->getFullname() . " ($user->email)</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td><input class="form-control" value="<?php echo APIKey::createSecret(); ?>" id="key" readonly/></td>
                    <td><input class="form-control" value="<?php echo APIKey::createSecret(); ?>" id="secret" readonly/></td>
                    <td class="text-end"><button class="btn btn-success" onclick="saveAPIKey()"><i class="fa fa-save"></i> Save</button></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;&nbsp;&nbsp;Secret will be encrypted once saved make sure to note it first.
                        </div>
                    </td>
                </tr>
                <?php
                    $APIKeys = APIKey::getAll();
                    foreach ($APIKeys as $APIKey) 
                    {
                        $user = User::getByID($APIKey->userid);
                ?>

                        <tr>
                            <td class="pt-3"><?php echo $user->getFullname(); ?> (<?php echo $user->email; ?>)</td>
                            <td><input class="form-control" value="<?php echo $APIKey->apikey; ?>" readonly/></td>
                            <td class="text-center pt-3"><i>Encrypted (<?php echo $APIKey->id; ?>)</i></td>
                            <td class="text-end"><button class="btn btn-danger" onclick="deleteAPIKey('<?php echo $APIKey->id; ?>')"><i class="fa fa-remove"></i></button></td>
                        </tr>

                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>