<?php
$ldap = SystemSetting::getByKey("ARC_LDAP_ENABLED");
$login = "Email Address";
if ($ldap->value == "1") {
    $login = "Username";
}
$reg = SystemSetting::getByKey("ARC_ALLOWREG");
?>

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group mb-0">
                    <div class="card p-2">
                        <div class="card-block">
                            <h1>Login</h1>
                            <div id="loginDiv">
                            <p class="text-muted">Sign In to your account</p>
                            <div class="input-group mb-1">
                                <span class="input-group-addon"><i class="icon-user"></i>
                                </span>
                                <input id="email" type="text" placeholder="<?php echo $login; ?>" autocomplete="off" class="form-control">
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-addon"><i class="icon-lock"></i>
                                </span>
                                <input id="password" type="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button id="loginBtn" type="button" class="btn btn-primary px-2">Login</button>
                                </div>
                                <div class="col-6 text-right">
                                    <button id="btnForgot" type="button" class="btn btn-link px-0">Forgot password?</button>
                                </div>
                            </div>
                            </div>

<div id="forgotDiv" style="display: none;">
    <p class="text-muted">Enter your email address</p>
                              <div class="input-group mb-1">
                                <span class="input-group-addon"><i class="icon-user"></i>
                                </span>
                            <input id="emailf" type="text" placeholder="Email Address" autocomplete="off" class="form-control">
                        </div>
                         <div class="row">
                                <div class="col-6">
                                    <button id="sendReset" class="btn btn-primary btn-xl">Send Reset Link</button>
                                </div>
                                <div class="col-6 text-right">
                                    <button class="btn btn-danger btn-xl" id="cancelBtn2">Cancel</button>
                                </div>
                            </div>
                        </div>


                        </div>
                    </div>
                    <div class="card card-inverse card-primary py-3 hidden-md-down" style="width:44%">
                        <div class="card-block text-center">
                            <div>
                                <h2>Sign up</h2>
                                <?php if ($reg->value == "true") { ?>
                                 <div class="input-group mb-1">
                                <span class="input-group-addon"><i class="icon-user"></i>
                                </span>
                                    <input maxlength="50" type="text" class="form-control" id="firstname" placeholder="Firstname">
                                </div>
                                <div class="input-group mb-1">
                                <span class="input-group-addon"><i class="icon-user"></i>
                                </span>
                                    <input maxlength="50" type="text" class="form-control" id="lastname" placeholder="Lastname">
                                </div>
                                <div class="input-group mb-1">
                                <span class="input-group-addon"><i class="icon-envelope-open"></i>
                                </span>
                                    <input maxlength="100" type="email" class="form-control" id="emailr" placeholder="Email address">
                                </div>
                                <div class="input-group mb-1">
                                <span class="input-group-addon"><i class="icon-lock"></i>
                                </span>
                                    <input maxlength="100" type="password" class="form-control" id="passwordr" placeholder="Password" autocomplete="off">
                                </div>
                                <div class="input-group mb-1">
                                <span class="input-group-addon"><i class="icon-lock"></i>
                                </span>
                                    <input maxlength="100" type="password" class="form-control" id="passwordr2" placeholder="Retype password" autocomplete="off">
                                </div>
                                        <button id="registerBtn" type="button" class="btn btn-primary active mt-1">Register Now!</button>
                                <?php } else { ?>
                                    <p>User registration has been disabled to the administrator</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
