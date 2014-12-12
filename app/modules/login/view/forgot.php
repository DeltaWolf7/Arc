<div class="page-header">
    <h1>Login :: Forgot Password</h1>
</div>

<form role="form">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Forgot Password</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="email">Email address</label>
                <input maxlength="100" type="text" class="form-control" id="email" placeholder="Enter email">
            </div>
        </div>
    </div>
    <button type="button" id="forgotBtn" class="btn btn-success">Request Reset</button>
    <a class="btn btn-danger" href="<?php echo system\Helper::arcGetModulePath(); ?>">Cancel</a>
</form>

<script>
    $("#forgotBtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "text",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {email: $("#email").val()},
            success: function (data, textStatus, jQxhr) {
                updateStatus(data);
            }
        })
    });
</script>