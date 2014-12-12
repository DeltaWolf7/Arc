<div class="page-header">
    <h1>System Settings <?php
        if (!empty(arcGetURLData("data2"))) {
            echo "<a href=\"" . arcGetModulePath() . "\"><span class=\"fa fa-arrow-circle-left\"></span></a>";
        }
        ?></h1>
</div>

<?php
if (arcGetURLData("data2") != "edit") {
    $settings = SystemSetting::getAll();
    ?>

    <table class="table table-striped">
        <tr><th>Key</th><th>Value</th></tr>
        <?php
        foreach ($settings as $setting) {
            echo "<tr><td><a href=\"" . arcGetModulePath() . "edit/" . $setting->key . "\">" . $setting->key . "</a></td><td>" . $setting->setting . "</td></tr>";
        }
        ?>

    </table>

    <?php
} else {

    $setting = SystemSetting::getByKey(arcGetURLData("data3"));
    ?>


    <form role="form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">&nbsp;</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="key">Key</label>
                    <input maxlength="100" type="text" class="form-control" id="key" placeholder="Setting key" value="<?php echo $setting->key; ?>">
                </div>
                <div class="form-group">
                    <label for="value">Value</label>
                    <input maxlength="255" type="text" class="form-control" id="value" placeholder="Setting value" value="<?php echo $setting->setting; ?>">
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-success" onclick="ajax.send('POST', {action: 'save', key: '#key', value: '#value'}, '<?php arcGetDispatch(); ?>', update, true)">Save</button>
        <button type="button" class="btn btn-danger" onclick="ajax.send('POST', {action: 'delete', key: '<?php echo $setting->key; ?>'}, '<?php arcGetDispatch(); ?>', update, true)">Delete</button>
    </form>

    <?php
}
?>

<script>
    function update(data) {
        updateStatus(data);
        var data2 = data.split('|');
        if (data2[0] == "success")
        {
            window.location = "<?php echo arcGetModulePath(); ?>";
        }    
    }
</script>