<div class="page-header">
    <h1>Login</h1>
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
    </div>
</div>
<a id="loginBtn" class="btn btn-primary">Login</a>
<a class="btn btn-default" href="<?php echo system\Helper::arcGetModulePath() . "forgot"; ?>">Forgot Password</a>

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