<?php
$user = system\Helper::arcGetUser();
?>

<div class="page-header">
    <h1><i class="fa fa-user"></i> My Details</h1>
</div>
<div class="panel panel-default">
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
            <input type="email" class="form-control" id="email" maxlength="100" placeholder="Email" value="<?php echo $user->email; ?>" disabled="true">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" maxlength="100" placeholder="Password" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="retype">Retype</label>
            <input type="password" class="form-control" id="password2" maxlength="100" placeholder="Retype" autocomplete="off">
        </div>
        <div id="status"></div>
    </div>
    <div class="panel-footer text-right">
        <a id="saveDetailsBtn" class="btn btn-primary"><i class="fa fa-save"></i> Save</a>
    </div>
</div>