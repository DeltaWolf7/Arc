<div class="page-header">
    <h1>Theme</h1>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Available themes</h3>
    </div>
    <div class="panel-body">
        <form role="form">
            <div class="form-group">
                <label for="theme"><span class="fa fa-exclamation-sign"></span> Theme</label>
                <select id="theme" class='form-control'>
                    <option value="">default</option>
                    <?php
                    $user = arcGetUser();
                    $selectedtheme = $user->getSettingByKey('ARC_THEME');
                    $themes = scandir(arcGetPath(true) . '/css/themes/');
                    foreach ($themes as $theme) {
                        if ($theme != '..' && $theme != '.') {
                            $themename = substr($theme, 0, strlen($theme) - 8);
                            echo '<option value="' . $themename . '"';
                            if ($selectedtheme->setting == $themename) {
                                echo ' selected';
                            }
                            echo '>' . $themename . '</option>' . PHP_EOL;
                        }
                    }
                    ?>
                </select>
                <input type="hidden" id="userid" value="<?php echo $user->id; ?>" />
            </div>
            <button type="button" class="btn btn-default" onclick="ajax.send('POST', {theme: '#theme', userid: '#userid'}, '<?php arcGetDispatch(); ?>', updateStatus, true)">Save</button>
        </form>
    </div>
</div>