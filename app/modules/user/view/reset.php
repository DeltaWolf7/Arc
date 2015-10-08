<div class="page-header">
    <h1><i class="fa fa-cog"></i> Reset Password</h1>
</div>

<?php
$data = explode("|", base64_decode(system\Helper::arcGetURLData("data1")));
if (!is_numeric($data[0])) {
    system\Helper::arcRedirect();
}
?>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-group">
            <label for="password">Password</label>
            <input maxlength="100" type="password" class="form-control" id="password" placeholder="Password" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="password2">Retype Password</label>
            <input maxlength="100" type="password" class="form-control" id="password2" placeholder="Retype password" autocomplete="off">
        </div>
        <div id="status"></div>
    </div>
    <div class="panel-footer text-right">
        <button id="btnReset" class="btn btn-primary">Reset</button>
    </div>
</div>


<script>
    $("#btnReset").click(function () {
        arcAjaxRequest('<?php system\Helper::arcGetDispatch(); ?>', {password: $("#password").val(), password2: $("#password2").val(),id: <?php echo $data[0]; ?>}, complete, null)
    });
    
    function complete(data) {
        updateStatus("status", updateStatusCallback);
    }

    function updateStatusCallback(data) {
        if (data.danger == 0) {
            $("#btnReset").prop("disabled", true);
            $("#password").prop("disabled", true);
            $("#password2").prop("disabled", true);
        }
    }
</script>