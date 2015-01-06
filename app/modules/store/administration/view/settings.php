<?php
$currencyDisplay = SystemSetting::keyExists("ARC_STORE_CURRENCYDISPLAY");
$currencySymbol = SystemSetting::keyExists("ARC_STORE_CURRENCYSYMBOL");
$storeVat = SystemSetting::keyExists("ARC_STORE_VAT");
$ordernumber = SystemSetting::getByKey("ARC_STORE_ORDERNUMBER");
?>

<div class="page-header">
    <h1>Store Settings</h1>
</div>

<form>
    <table class="table table-striped">
        <tr><th>Setting</th><th>Value</th></tr>
        <tr><td>Currency Symbol</td><td><input type="text" class="form-control" id="currencySymbol" value="<?php echo $currencySymbol->value; ?>"></td></tr>
        <tr><td>Currency Display Location</td><td><select class="form-control" id="currencyDisplay">
                    <option value="Left" <?php
                    if ($currencyDisplay->value == "Left") {
                        echo " selected";
                    }
                    ?>>Left</option>
                    <option value="Right"<?php
                    if ($currencyDisplay->value == "Right") {
                        echo " selected";
                    }
                    ?>>Right</option>
                </select></td></tr>
        <tr><td>VAT Percent (%)</td><td><input type="text" class="form-control" id="vat" value="<?php echo $storeVat->value; ?>"></td></tr>
        <tr><td>Next Order Number</td><td><?php echo $ordernumber->value; ?></td></tr>
    </table>
    <div class="text-right">
        <button type="button" class="btn btn-default" onclick="saveSettings();"><span class="fa fa-save"></span> Save</button>
    </div>
</form>

<script>
    function saveSettings() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "savesettings", currencySymbol: $("#currencySymbol").val(),
                currencyDisplay: $('#currencyDisplay').val(), vat: $("#vat").val()},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
            }
        });
    }
</script>