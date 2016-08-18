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

<div class="container">
    <div class="row">
        <div class="span4 offset3">
            <div class="signin">
                <div id="logo">
                    <img src="{{arc:sitelogo}}" alt="">
                </div>
                <div class="tab-content">
                    <div id="login" class="tab-pane active">

                        <p class="muted tac">
                            Enter your username and password
                        </p>
                        <div class="control-group">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" maxlength="100" type="text" id="email"  placeholder="<?php echo $login; ?>">
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input maxlength="100" type="password" class="form-control" id="password" placeholder="Password">
                            </div>

                        </div>    

                        <a id="loginBtn" class="btn btn-inverse btn-block">Sign in</a>

                    </div>
                    <div id="forgot" class="tab-pane">

                        <p class="muted tac">
                            Enter your valid e-mail
                        </p>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input maxlength="100" type="email" class="form-control" id="emailf" placeholder="Email address">
                        </div>

                        <a id="sendReset" class="btn btn-inverse btn-block">Recover Password</a>
                    </div>
                    <div id="signup" class="tab-pane">

                        <div class="control-group">
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="fa fa-user"></i></span>
                                    <input maxlength="50" type="text" class="form-control" id="firstname" placeholder="Firstname">
                                </div>
                            </div>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="fa fa-user"></i></span>
                                    <input maxlength="50" type="text" class="form-control" id="lastname" placeholder="Lastname">
                                </div>
                            </div>
                            <?php if ($company->value == "true") { ?>
                                <div class="controls">
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="fa fa-home"></i></span>
                                        <input maxlength="50" type="text" class="form-control" id="company" placeholder="Company">
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="fa fa-envelope"></i></span>
                                    <input maxlength="100" type="email" class="form-control" id="emailr" placeholder="Email address">
                                </div>
                            </div>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="fa fa-lock"></i></span>
                                    <input maxlength="100" type="password" class="form-control" id="passwordr" placeholder="Password" autocomplete="off">
                                </div>
                            </div>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="fa fa-lock"></i></span>
                                    <input maxlength="100" type="password" class="form-control" id="passwordr2" placeholder="Retype password" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <a class="btn btn-inverse btn-block" id="registerBtn">Register</a>
                    </div>
                </div>

                <div class="text-center">
                    <a class="muted" href="#login" data-toggle="tab">Login</a>&nbsp;
                    <a class="muted" href="#forgot" data-toggle="tab">Forgot Password</a>&nbsp;

                    <?php if ($reg->value == "true") { ?>
                        <a class="muted" href="#signup" data-toggle="tab">Register</a>
                    <?php } else { ?>
                        <i class="muted">Registration disabled</i>                                                                
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</div>
