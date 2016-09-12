<?php
$user = system\Helper::arcGetUser();
$profileImage = SystemSetting::getByKey("ARC_USER_IMAGE", $user->id);

$image = "<i class=\"fa fa-user fa-5x\"></i>";
if (!empty($profileImage->value)) {
    $image = "<img class=\"img-responsive img-thumbnail\" src=\"" . system\Helper::arcGetPath() . "assets/profile/" . $profileImage->value . "\" />";
}
$company = SystemSetting::getByKey("ARC_REQUIRECOMPANY");
?>

<div class="panel panel-default">
    <div class="panel-body">
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
                    <?php if ($company->value == "true") { ?>
                        <label for="company">Company Association(s)</label>
                        <div class="form-group">
                            <ul class="list-group">
                            <?php
                                $companies = $user->getCompanies();
                                foreach ($companies as $company) {
                                    echo "<li class=\"list-group-item\">{$company->name}</li>";
                                }
                            ?>
                            </ul>
                        </div>
                    <?php } ?>
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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Profile Picture
                    </div>
                    <div class="panel-body text-center">
                        <?php echo $image; ?>
                    </div>
                    <div class="panel-footer">
                        <a id="uploadImage" class="btn btn-primary btn-block btn-file"><input type="file">Change Image</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right">
            <a id="saveDetailsBtn" class="btn btn-primary">Update</a>
        </div>
    </div>
</div>
