<?php
$user = system\Helper::arcGetUser();
$profileImage = $user->getProfileImage();

$image = "<div class=\"card-body\">No profile image</div>";
if (!empty($profileImage)) {
    $image = "<img class=\"card-img-top text-center\" src=\"" . $profileImage . "\" />";
}
?>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form id="detailsForm">
                            <div class="form-group">
                                <label for="firstname">First name</label>
                                <input type="firstname" class="form-control" name="firstname" maxlength="50" placeholder="First name" value="<?php echo $user->firstname; ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last name</label>
                                <input type="lastname" class="form-control" name="lastname" maxlength="50" placeholder="Last name" value="<?php echo $user->lastname; ?>">
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