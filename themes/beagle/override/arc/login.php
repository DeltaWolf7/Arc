<?php
$ldap = SystemSetting::getByKey("ARC_LDAP");
$ldapData = $ldap->getArrayFromJson();
$login = "Email Address";
if ($ldapData["ldap"] == "true") {
    $login = "Username";
}
$reg = SystemSetting::getByKey("ARC_ALLOWREG");
$company = SystemSetting::getByKey("ARC_REQUIRECOMPANY");
?>

<div class="be-wrapper be-login">
    <div class="be-content">
        <div class="main-content">
            <div class="splash-container">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading"><img src="{{arc:sitelogo}}" alt="logo" class="logo-img"><span class="splash-description">Please enter your user information.</span></div>
                    <div class="panel-body" id="loginDiv">
                        <div class="form-group">
                            <input id="email" type="text" placeholder="<?php echo $login; ?>" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" placeholder="Password" class="form-control">
                        </div>
                        <div class="form-group login-submit">
                            <a id="loginBtn" class="btn btn-primary btn-xl">Sign me in</a>
                        </div>
                    </div>
                    <div class="panel-body" id="registerDiv" style="display: none;">
                        <div class="form-group">
                            <input maxlength="50" type="text" class="form-control" id="firstname" placeholder="Firstname">
                        </div>
                        <div class="form-group">
                            <input maxlength="50" type="text" class="form-control" id="lastname" placeholder="Lastname">
                        </div>
                        <?php if ($company->value == "true") { ?>
                            <div class="form-group">
                                <input maxlength="50" type="text" class="form-control" id="company" placeholder="Company">
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <input maxlength="100" type="email" class="form-control" id="emailr" placeholder="Email address">
                        </div>
                        <div class="form-group">
                            <input maxlength="100" type="password" class="form-control" id="passwordr" placeholder="Password" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input maxlength="100" type="password" class="form-control" id="passwordr2" placeholder="Retype password" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <a id="registerBtn" class="btn btn-primary btn-xl">Register</a>
                            <br /><br />
                            <a class="btn btn-danger btn-xl" id="cancelBtn">Cancel</a>
                        </div>
                    </div>
                    <div class="panel-body" id="forgotDiv" style="display: none;">
                        <div class="form-group">
                            <input id="emailf" type="text" placeholder="Email Address" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group login-submit">
                            <a id="sendReset" class="btn btn-primary btn-xl">Send Reset Link</a><br /><br />
                            <a class="btn btn-danger btn-xl" id="cancelBtn2">Cancel</a>
                        </div>
                    </div>
                </div>
                <div class="splash-footer">
                    <?php if ($reg->value == "true") { ?>
                        <a id="btnRegsiter">Sign Up</a> / 
                    <?php } ?>
                    <a id="btnForgot">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
</div>