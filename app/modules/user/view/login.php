<div class="page-header">
    <h1><i class="fa fa-sign-in"></i> Login</h1>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-group">
            <label for="email">Email address</label>
            <input maxlength="100" type="text" class="form-control" id="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input maxlength="100" type="password" class="form-control" id="password" placeholder="Password">
        </div>
        <div id="status"></div>
    </div>
    <div class="panel-footer text-right">
        <a id="loginBtn" class="btn btn-primary">Login</a>
        <a class="btn btn-default" href="<?php echo system\Helper::arcGetModulePath("user") . "forgot"; ?>">Forgot Password</a>
    </div>
</div>