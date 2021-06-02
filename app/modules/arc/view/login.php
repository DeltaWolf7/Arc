<?php
$ldap = SystemSetting::getByKey("ARC_LDAP_ENABLED");
$login = "Email Address";
if ($ldap->value == "1") {
    $login = "Username";
}
$reg = SystemSetting::getByKey("ARC_ALLOWREG");
?>

<div class="collapse show" id="collapseA">
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="border p-4 rounded">
                    <h3>Sign in</h3>
                    <form>
                        <div class="row">
                            <div class="col-12">
                                <label for="email" class="form-label">Email Address</label>
                                <input maxlength="100" type="text" class="form-control" id="email"
                                    placeholder="<?php echo $login; ?>" autocomplete="username">
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group" id="show_hide_password">
                                    <input maxlength="100" type="password" class="form-control" id="password"
                                        placeholder="Password" autocomplete="current-password">
                                    <a href="javascript:;" class="input-group-text bg-transparent"><i
                                            class="far fa-eye-slash"></i></a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-end">
                                    <a href="#" id="btnForgot">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-grid">
                                    <button id="loginBtn" class="btn btn-primary"><i class="fas fa-unlock-alt"></i>
                                        Login</button>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-grid">
                                    <?php if ($reg->value == "true") { ?>
                                    <button id="btnReg" class="btn btn-light"><i class="far fa-user"></i>
                                        Register</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="collapse" id="collapseB">
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="border p-4 rounded">
                    <h3>New user registration</h3>
                    <form>
                        <div class="row">
                            <div class="col-12">
                                <label for="firstname" class="form-label">Firstname</label>
                                <input maxlength="50" type="text" class="form-control" id="firstname"
                                    placeholder="First name">
                            </div>
                            <div class="col-12">
                                <label for="lastname" class="form-label">Lastname</label>
                                <input maxlength="50" type="text" class="form-control" id="lastname"
                                    placeholder="Last name">
                            </div>
                            <div class="col-12">
                                <label for="emailr" class="form-label">Email address</label>
                                <input maxlength="100" type="email" class="form-control" id="emailr"
                                    placeholder="Email address">
                            </div>
                            <div class="col-12">
                                <label for="passwordr" class="form-label">Password</label>
                                <input maxlength="100" type="password" class="form-control" id="passwordr"
                                    placeholder="Password" autocomplete="off">
                            </div>
                            <div class="col-12">
                                <label for="passwordr2" class="form-label">Retype password</label>
                                <input maxlength="100" type="password" class="form-control" id="passwordr2"
                                    placeholder="Retype password" autocomplete="off">
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-grid">
                                    <button id="registerBtn" class="btn btn-primary"><i class="far fa-user"></i>
                                        Register</button>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-grid">
                                    <button class="btn btn-light" id="btnBackLogin"><i class="fas fa-chevron-left"></i>
                                        Back to Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="collapse" id="collapseC">
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="border p-4 rounded">
                    <h3>Forgot Password</h3>
                    <form>
                        <div class="row">
                            <div class="col-12">
                                <label for="emailf" class="form-label">Email Address</label>
                                <input maxlength="100" type="email" class="form-control" id="emailf"
                                    placeholder="Email address">
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-grid">
                                    <button id="sendReset" class="btn btn-primary">Request Reset</button>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-grid">
                                    <button class="btn btn-light" id="forgotCancel"><i class="fas fa-chevron-left"></i>
                                        Back to Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>