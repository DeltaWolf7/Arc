<div class="page-header">
    <h1>Login :: Forgot Password</h1>
</div>

<?php
    $data = explode("|", base64_decode(system\Helper::arcGetURLData("data1")));
    if (!is_numeric($data[0])) {
        system\Helper::arcRedirect();
    }
?>

<form role="form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">New Password</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input maxlength="100" type="password" class="form-control" id="password" placeholder="Password" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="password2">Retype Password</label>
                    <input maxlength="100" type="password" class="form-control" id="password2" placeholder="Retype password" autocomplete="off">
                </div>
            </div>
        </div>
        <button type="button" id="btnReset" class="btn btn-primary">Reset</button>
    </form>

<script>
    $("#btnReset").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {password: $("#password").val(), password2: $("#password2").val(), id: <?php echo $data[0]; ?>},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
                if (jdata.status == "success") {
                   $("#btnReset").prop("disabled", true);
                   $("#password").prop("disabled", true);
                   $("#password2").prop("disabled", true);
                }
            }
        })
    });
</script>