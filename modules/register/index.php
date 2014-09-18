<div class="page-header">
    <h1>Register</h1>
</div>

<form role="form">
    <div class="form-group">
        <label for="name">Name</label>
        <input maxlength="100" type="text" class="form-control" id="name" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input maxlength="100" type="text" class="form-control" id="email" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input maxlength="100" type="password" class="form-control" id="password" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="password2">Retype Password</label>
        <input maxlength="100" type="password" class="form-control" id="password2" placeholder="Retype password">
    </div>
    <button type="button" class="btn btn-default" onclick="ajax.send('POST', {name: '#name', email: '#email', password: '#password', password2: '#password2'}, '<?php arcGetDispatch(); ?>', updateStatus, true)">Register</button>
</form>