<?php
$ldap = SystemSetting::getByKey("ARC_LDAP_ENABLED");
$login = "Email Address";
if ($ldap->value == "1") {
    $login = "Username";
}
$reg = SystemSetting::getByKey("ARC_ALLOWREG");
?>


		
		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
		    <div class="cls-content-sm panel">
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
		                <h1 class="h3">Account Login</h1>
		                <p>Sign In to your account</p>
		            </div>
		                <div class="form-group">
		                    <input id="email" type="text" class="form-control" placeholder="Email Address" autofocus>
		                </div>
		                <div class="form-group">
		                    <input id="password" type="password" class="form-control" placeholder="Password">
		                </div>
		                <button id="loginBtn" class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
		        </div>
		
		        <div class="pad-all">
		            <a href="#" class="btn-link mar-rgt">Forgot password ?</a>
		            <a href="#" class="btn-link mar-lft">Create a new account</a>
		
		            <div class="media pad-top bord-top">
		                <div class="pull-right">
		                    <a href="#" class="pad-rgt"><i class="psi-facebook icon-lg text-primary"></i></a>
		                    <a href="#" class="pad-rgt"><i class="psi-twitter icon-lg text-info"></i></a>
		                    <a href="#" class="pad-rgt"><i class="psi-google-plus icon-lg text-danger"></i></a>
		                </div>
		                <div class="media-body text-left text-bold text-main">
		                    Login with
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!--===================================================-->

