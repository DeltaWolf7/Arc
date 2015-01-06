<div class="page-header">
    <h1>Login</h1>
</div>

<form role="form">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">&nbsp;</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="email">Email address</label>
                <input maxlength="100" type="text" class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input maxlength="100" type="password" class="form-control" id="password" placeholder="Password">
            </div>
        </div>
    </div>
    <button type="button" id="loginBtn" class="btn btn-primary">Login</button>
    <a class="btn btn-default" href="<?php echo system\Helper::arcGetModulePath() . "forgot"; ?>">Forgot Password</a>
</form>

<script>
    $("#loginBtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {email: $("#email").val(), password: $("#password").val()},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
                if (jdata.status == "success") {
                    window.location = "<?php echo system\Helper::arcGetPath(); ?>";
                }
            }
        });
    });
</script>