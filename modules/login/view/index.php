<div class="page-header">
    <h1>Login</h1>
</div>

<?php
if (arcGetURLData("data1") == null) {
    ?>
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
        <button type="button" class="btn btn-default" onclick="ajax.send('POST', {action: 'login', email: '#email', password: '#password'}, '<?php arcGetDispatch(); ?>', login, true)">Login</button>
        <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo arcGetModulePath() . "/forgot"; ?>'">Forgot Password</button>
    </form>
    <?php
} elseif (arcGetURLData("data1") == "forgot") {
    ?>

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
        <button type="button" class="btn btn-default" onclick="ajax.send('POST', {action: 'forgot', email: '#email'}, '<?php arcGetDispatch(); ?>', updateStatus, true)">Request Reset</button>
    </form>

    <?php
} elseif (arcGetURLData("data1") == "reset") {
    $user = User::getByEmail(arcGetURLData("data3"));
    if ($user->id != arcGetURLData("data2")) {
        arcRedirect("/login");
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
                    <input maxlength="100" type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password2">Retype Password</label>
                    <input maxlength="100" type="password" class="form-control" id="password2" placeholder="Retype password">
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-default" onclick="ajax.send('POST', {action: 'reset', password: '#password', retype: '#password2', id: '<?php echo arcGetURLData("data2"); ?>'}, '<?php arcGetDispatch(); ?>', updateStatus, true)">Reset</button>
    </form>

    <?php
}
?>

<script>
    function login(data) {
        var data2 = data.split('|');
        if (data2[0] == "success")
        {
            window.location = "<?php echo ARCWWW; ?>";
        }
        updateStatus(data);
    }
</script>