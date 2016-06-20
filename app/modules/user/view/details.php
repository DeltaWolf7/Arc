<?php
$user = system\Helper::arcGetUser();
$profileImage = SystemSetting::getByKey("ARC_USER_IMAGE", $user->id);

$image = "<i class=\"fa fa-user fa-5x\"></i>";
if (!empty($profileImage->value)) {
    $image = "<img style=\"max-width: 100px;\" src=\"" . system\Helper::arcGetPath() . "assets/profile/" . $profileImage->value . "\" />";
}
?>

<div class="row">
    <div class="col-md-8">
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
    <div class="col-md-4">
        <div class="form-group text-center">
            <?php echo $image; ?>
            <a id="uploadImage" class="btn btn-primary btn-block btn-file"><input type="file">Change Image</a>
        </div>
    </div>
</div>
<div class="text-right">
    <a id="saveDetailsBtn" class="btn btn-primary">Update</a>
</div>
