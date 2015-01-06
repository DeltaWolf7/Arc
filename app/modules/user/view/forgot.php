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
                <input maxlength="100" type="text" class="form-control" id="email" placeholder="Enter email" autocomplete="off">
            </div>
        </div>
    </div>
    <button type="button" id="forgotBtn" class="btn btn-primary">Request Reset</button>
    <a class="btn btn-default" href="<?php echo system\Helper::arcGetModulePath(); ?>">Cancel</a>
</form>

<script>
    $("#forgotBtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {email: $("#email").val()},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
            }
        })
    });
</script>

<?php
//echo system\Helper::arcSendMail("craig@grangecomputers.co.uk", "test", "test2");