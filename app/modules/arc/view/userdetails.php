<?php
$user = system\Helper::arcGetUser();
$profileImage = SystemSetting::getByKey("ARC_USER_IMAGE", $user->id);

$image = "<div class=\"card-body\">No profile image</div>";
if (!empty($profileImage->value)) {
    $image = "<img class=\"card-img-top text-center\" src=\"" . system\Helper::arcGetPath() . "assets/profile/" . $profileImage->value . "\" />";
}
?>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form id="detailsForm">
                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input type="firstname" class="form-control" name="firstname" maxlength="50" placeholder="Firstname" value="<?php echo $user->firstname; ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Lastname</label>
                                <input type="lastname" class="form-control" name="lastname" maxlength="50" placeholder="Lastname" value="<?php echo $user->lastname; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" maxlength="100" placeholder="Email" value="<?php echo $user->email; ?>" disabled="true">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" maxlength="100" placeholder="Password" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="retype">Retype</label>
                                <input type="password" class="form-control" name="password2" maxlength="100" placeholder="Retype" autocomplete="off">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-right">
                        <button id="saveDetailsBtn" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <?php echo $image; ?>
                    <div class="card-footer">
                        <button id="uploadImage" class="btn btn-primary btn-block btn-file"><input type="file">Change Image</button>
                    </div>
                </div>
            </div>
        </div>