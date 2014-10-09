<div class="page-header">
    <h1>My Details</h1>
</div>

<?php
$user = arcGetUser();
?>

<form role="form">



    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Personal</h3>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input type="firstname" class="form-control" id="firstname" maxlength="50" placeholder="Firstname" value="<?php echo $user->firstname; ?>">
            </div>
            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="lastname" class="form-control" id="lastname" maxlength="50" placeholder="Lastname" value="<?php echo $user->lastname; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" maxlength="100" placeholder="Email" value="<?php echo $user->email; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" maxlength="100" placeholder="Password" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="retype">Retype</label>
                <input type="password" class="form-control" id="retype" maxlength="100" placeholder="Retype" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="text-right">
        <input type="hidden" id="userid" value="<?php echo $user->id; ?>" />
        <button type="button" class="btn btn-default" onclick="ajax.send('POST', {theme: '#theme', userid: '#userid', firstname: '#firstname', lastname: '#lastname', password: '#password', retype: '#retype', email: '#email'}, '<?php arcGetDispatch(); ?>', updateStatus, true)">Update</button>
    </div>
</form>