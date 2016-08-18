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
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login</title>
        {{arc:header}}
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="span4 offset4">
                    <div class="signin">
                        <div id="logo">
                            <img src="{{arc:sitelogo}}" alt="">
                        </div>
                        <div class="tab-content">
                            <div id="login" class="tab-pane active">
                               <form name="loginForm">
                                    <p class="muted tac">
                                        Enter your username and password
                                    </p>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="fa fa-user"></i></span>
                                                <input maxlength="100" type="text" name="email" placeholder="<?php echo $login; ?>">
                                            </div>
                                        </div>
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="fa fa-lock"></i></span>
                                                <input maxlength="100" type="password" class="form-control" name="password" placeholder="Password">
                                            </div>
                                        </div>
                                    </div>
                                    <a id="loginBtn" class="btn btn-inverse btn-block">Sign in</a>
                                </form>
                            </div>
                            <div id="forgot" class="tab-pane">
                               <form id="resetForm">
                                    <p class="muted tac">
                                        Enter your valid e-mail
                                    </p>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="fa fa-envelope"></i></span>
                                                <input maxlength="100" type="email" class="form-control" name="emailf" placeholder="Email address">
                                            </div>
                                        </div>
                                    </div>
                                    <a id="sendReset" class="btn btn-inverse btn-block">Recover Password</a>
                                </form>
                            </div>
                            <div id="signup" class="tab-pane">
                                <form id="registerForm">
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="fa fa-user"></i></span>
                                                <input maxlength="50" type="text" class="form-control" name="firstname" placeholder="Firstname">
                                            </div>
                                        </div>
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="fa fa-user"></i></span>
                                                <input maxlength="50" type="text" class="form-control" name="lastname" placeholder="Lastname">
                                            </div>
                                        </div>
                                        <?php if ($company->value == "true") { ?>
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="fa fa-home"></i></span>
                                                <input maxlength="50" type="text" class="form-control" name="company" placeholder="Company">
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="fa fa-envelope"></i></span>
                                                <input maxlength="100" type="email" class="form-control" name="emailr" placeholder="Email address">
                                            </div>
                                        </div>
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="fa fa-lock"></i></span>
                                                <input maxlength="100" type="password" class="form-control" name="passwordr" placeholder="Password" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="fa fa-lock"></i></span>
                                                <input maxlength="100" type="password" class="form-control" name="passwordr2" placeholder="Retype password" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <a class="btn btn-inverse btn-block" id="registerBtn">Register</a>
                                </form>
                            </div>
                        </div>

                        <ul class="inline">
                            <li><a class="muted" href="#login" data-toggle="tab">Login</a></li>
                            <li><a class="muted" href="#forgot" data-toggle="tab">Forgot Password</a></li>
                            <li>
                                <?php if ($reg->value == "true") { ?>
                                    <a class="muted" href="#signup" data-toggle="tab">Register</a>
                                <?php } else { ?>
                                    Registration disabled                                                                
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{arc:footer}}
    </body>
</html>