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

                    <label for="firstname" class="form-label">First name</label>
                    <input type="firstname" class="form-control" name="firstname" maxlength="50"
                        placeholder="First name" value="<?php echo $user->firstname; ?>">

                    <label for="lastname" class="form-label">Last name</label>
                    <input type="lastname" class="form-control" name="lastname" maxlength="50" placeholder="Last name"
                        value="<?php echo $user->lastname; ?>">

                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" maxlength="100" placeholder="Email"
                        value="<?php echo $user->email; ?>" disabled="true">

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <label for="password" class="form-label">Password (Leave blank to keep same)</label>
                    <input type="password" class="form-control" name="password" maxlength="100" placeholder="Password"
                        autocomplete="off">

                    <label for="retype" class="form-label">Retype</label>
                    <input type="password" class="form-control" name="password2" maxlength="100" placeholder="Retype"
                        autocomplete="off">
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $image; ?>
                        </div>
                        <div class="col-md-6">
                            <button id="uploadImage" class="btn btn-primary btn-block btn-file mt-5"><input
                                    type="file"><i class="fa fa-pencil"></i> Change
                                Image</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button id="saveDetailsBtn" class="btn btn-success mt-3"><i class="far fa-save"></i>
                    Save</button>
            </div>
        </div>
    </div>
</form>