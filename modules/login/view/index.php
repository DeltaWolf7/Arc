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
    <button type="button" class="btn btn-default" onclick="ajax.send('POST', {email: '#email', password: '#password'}, '<?php arcGetDispatch(); ?>', login, true)">Login</button>
</form>

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