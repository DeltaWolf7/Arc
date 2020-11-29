<?php
$user = system\Helper::arcGetUser();
$profileImage = $user->getProfileImage();
$image = "No image";
if (!empty($profileImage)) {
    $image = "<img class=\"img-fluid\" src=\"" . $profileImage . "\" />";
}
?>
<form id="detailsForm">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Personal</h4>
                    <div class="form-group">
                        <label for="firstname">First name</label>
                        <input type="firstname" class="form-control" name="firstname" maxlength="50"
                            placeholder="First name" value="<?php echo $user->firstname; ?>">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last name</label>
                        <input type="lastname" class="form-control" name="lastname" maxlength="50"
                            placeholder="Last name" value="<?php echo $user->lastname; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" maxlength="100" placeholder="Email"
                            value="<?php echo $user->email; ?>" disabled="true">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="password">Password (Leave blank to keep same)</label>
                        <input type="password" class="form-control" name="password" maxlength="100"
                            placeholder="Password" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="retype">Retype</label>
                        <input type="password" class="form-control" name="password2" maxlength="100"
                            placeholder="Retype" autocomplete="off">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?php echo $image; ?>
                        </div>
                        <div class="col-md-8">
                            <button id="uploadImage" class="btn btn-primary btn-block btn-file mt-5"><input
                                    type="file"><i class="fa fa-pencil"></i> Change
                                Image</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button id="saveDetailsBtn" class="btn btn-success mt-3"><i class="far fa-save"></i>
                    Save</button>
            </div>
        </div>
    </div>
</form>