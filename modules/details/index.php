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
                <input type="firstname" class="form-control" id="firstname" placeholder="Firstname" value="<?php echo $user->firstname; ?>">
            </div>
            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="lastname" class="form-control" id="lastname" placeholder="Lastname" value="<?php echo $user->lastname; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $user->email; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="retype">Retype</label>
                <input type="password" class="form-control" id="retype" placeholder="Retype" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Style</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="theme"><span class="fa fa-exclamation-sign"></span> Theme</label>
                <select id="theme" class='form-control'>
                    <option value="">default</option>
                    <?php
                    
                    $selectedtheme = $user->getSettingByKey("ARC_THEME");
                    $themes = scandir(arcGetPath(true) . "/css/themes/");
                    foreach ($themes as $theme) {
                        if ($theme != ".." && $theme != ".") {
                            $themename = substr($theme, 0, strlen($theme) - 8);
                            echo "<option value='" . $themename . "'";
                            if ($selectedtheme->setting == $themename) {
                                echo " selected";
                            }
                            echo ">" . $themename . "</option>" . PHP_EOL;
                        }
                    }
                    ?>
                </select>
                
            </div>
        </div>
    </div>
    <input type="hidden" id="userid" value="<?php echo $user->id; ?>" />
    <button type="button" class="btn btn-default" onclick="ajax.send('POST', {theme: '#theme', userid: '#userid', firstname: '#firstname', lastname: '#lastname', password: '#password', retype: '#retype', email: '#email'}, '<?php arcGetDispatch(); ?>', updateStatus, true)">Update</button>
</form>