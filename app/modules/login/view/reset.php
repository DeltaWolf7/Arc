<div class="page-header">
    <h1>Login :: Forgot Password</h1>
</div>

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