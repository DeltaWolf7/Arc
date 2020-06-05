<?php
$ldap = SystemSetting::getByKey("ARC_LDAP_ENABLED");
$login = "Email Address";
if ($ldap->value == "1") {
    $login = "Username";
}
$reg = SystemSetting::getByKey("ARC_ALLOWREG");
?>

    <div class="collapse show" id="collapseA">
        <div class="row">
                <div class="col-md-6 col-md-offset-1">
                    <div class="card">
                        <div class="card-body">
                            <h3>Sign in</h3>
                            <div class="form-group">
                                 <input maxlength="100" type="text" class="form-control" id="email" placeholder="<?php echo $login; ?>">
                             </div>
                            <div class="form-group">
                                  <input maxlength="100" type="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <div class="text-right">
                                <button id="loginBtn" class="btn btn-primary btn-block">Login</button><br />
                                <a href="#" id="btnForgot">Problems signing in?</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <?php if ($reg->value == "true") { ?>

                                <h3>New user? Sign up!</h3>
                                <p>Creating a new account is fast and simple.</p>
                                <p>All you need is your email address and password of your choice. Click the button below to begin your registration now.</p>

                            <?php } else { ?>
                                <h3>Registration</h3>
                                <p>Registration has been disabled by administrator.</p>                                                                
                            <?php } ?>
                            <?php if ($reg->value == "true") { ?>
                                <button class="btn btn-primary btn-block" onclick="switchView();">Create account</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    

    <div class="collapse" id="collapseB">
    <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 col-md-offset-1">
            <div class="card">
                <div class="card-body">
                    <h3>New user registration</h3>  
                    <div class="form-group">
                        <input maxlength="50" type="text" class="form-control" id="firstname" placeholder="First name">
                    </div>
                    <div class="form-group">
                        <input maxlength="50" type="text" class="form-control" id="lastname" placeholder="Last name">
                    </div>
                        <div class="form-group">
                            <input maxlength="100" type="email" class="form-control" id="emailr" placeholder="Email address">
                        </div>
                        <div class="form-group">
                            <input maxlength="100" type="password" class="form-control" id="passwordr" placeholder="Password" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input maxlength="100" type="password" class="form-control" id="passwordr2" placeholder="Retype password" autocomplete="off">
                        </div>
                        <button id="registerBtn" class="btn btn-primary btn-block">Register</button>
                        <button class="btn btn-danger btn-block" onclick="switchView();">Already registered? Sign in</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <div class="collapse" id="collapseC">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 col-md-offset-1">
                <div class="card">
                    <div class="card-body">
                        <h3>Forgot Password</h3>
                    
                            <div class="form-group">
                                <input maxlength="100" type="email" class="form-control" id="emailf" placeholder="Email address">
                            </div>
                    
                        <button id="sendReset" class="btn btn-primary btn-block">Request Reset</button>
                        <button class="btn btn-danger btn-block" id="forgotCancel">Cancel</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>






