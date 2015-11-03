<div class="row">
    <div class="collapse in" id="collapseA">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <h3>Sign in</h3>
            <div class="form-group">
                <input maxlength="100" type="text" class="form-control" id="email" placeholder="Email Address">
            </div>
            <div class="form-group">
                <input maxlength="100" type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <a id="loginBtn" class="btn btn-primary btn-block">Login</a>
            <p><a>Problems signing in?</a></p>
        </div>
        <div class="col-md-5">
            <h3>New user? Sign up!</h3>
            <p>Creating a new account is fast and simple.</p>
            <p>All you need is your email address and password of your choice. Click the button below to begin your registration now.</p>
            <a class="btn btn-primary btn-block" onclick="switchView();">Create account</a>
        </div>
        <div class="col-md-1"></div>
    </div>

    <div class="collapse" id="collapseB">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>New user registration</h3>
            <div class="form-group">
                <input maxlength="50" type="text" class="form-control" id="firstname" placeholder="Firstname">
            </div>
            <div class="form-group">
                <input maxlength="50" type="text" class="form-control" id="lastname" placeholder="Lastname">
            </div>
            <div class="form-group">
                <input maxlength="100" type="text" class="form-control" id="emailr" placeholder="Email address">
            </div>
            <div class="form-group">
                <input maxlength="100" type="password" class="form-control" id="passwordr" placeholder="Password" autocomplete="off">
            </div>
            <div class="form-group">
                <input maxlength="100" type="password" class="form-control" id="passwordr2" placeholder="Retype password" autocomplete="off">
            </div>
            <a id="registerBtn" class="btn btn-primary btn-block">Register</a>
            <p><a onclick="switchView();">Already registered? Login</a></p>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>    
<div id="status"></div>






