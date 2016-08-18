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
<div class="row">
    <div class="collapse in" id="collapseA">
        <div class="row">
      
                <div class="col-md-5 col-md-offset-1">
                    <h3>Sign in</h3>
                    <form name="loginForm">
                        <div class="form-group">
                            <input maxlength="100" type="text" class="form-control" id="email" placeholder="<?php echo $login; ?>">
                        </div>
                        <div class="form-group">
                            <input maxlength="100" type="password" class="form-control" id="password" placeholder="Password">
                        </div>
              
                </div>
                <div class="col-md-5">
                    <?php if ($reg->value == "true") { ?>

                        <h3>New user? Sign up!</h3>
                        <p>Creating a new account is fast and simple.</p>
                        <p>All you need is your email address and password of your choice. Click the button below to begin your registration now.</p>

                    <?php } else { ?>
                        <h3>Registration</h3>
                        <p>Registration has been disabled by administrator.</p>                                                                
                    <?php } ?>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <a id="loginBtn" class="btn btn-primary btn-block">Login</a>
                <a class="btn" id="btnForgot">Problems signing in?</a>
            </div>
            <?php if ($reg->value == "true") { ?>
                <div class="col-md-5">
                    <a class="btn btn-primary btn-block" onclick="switchView();">Create account</a>
                </div>
            <?php } ?>
        </div>
    </div>
    

    <div class="collapse" id="collapseB">
        <div class="col-md-6 col-md-offset-1">
            <h3>New user registration</h3>
        
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
   
            <a id="registerBtn" class="btn btn-primary btn-block">Register</a>
            <a class="btn" onclick="switchView();">Already registered? Sign in</a>
        </div>
    </div>

    <div class="collapse" id="collapseC">
        <div class="col-md-6 col-md-offset-1">
            <h3>Forgot Password</h3>
         
                <div class="form-group">
                    <input maxlength="100" type="email" class="form-control" id="emailf" placeholder="Email address">
                </div>
           
            <a id="sendReset" class="btn btn-primary btn-block">Request Reset</a>
            <a class="btn" id="forgotCancel">Cancel</a>
        </div>
    </div>
</div>






