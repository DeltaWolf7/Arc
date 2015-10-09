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
    setSID('<?php echo $data[0]; ?>');
</script>