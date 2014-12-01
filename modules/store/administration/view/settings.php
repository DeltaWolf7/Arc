<?php
$currenySymbol = SystemSetting::getByKey("ARC_STORE_CURRENCYSYMBOL");
if ($currenySymbol->id == 0) {
    $currenySymbol->setting = "£";
    $currenySymbol->update();
}

$currenyDisplay = SystemSetting::getByKey("ARC_STORE_CURRENCYDISPLAY");
if ($currenyDisplay->id == 0) {
    $currenyDisplay->setting = "Left";
    $currenyDisplay->update();
}

$vat = SystemSetting::getByKey("ARC_STORE_VAT");
if ($vat->id == 0) {
    $vat->setting = "20";
    $vat->update();
}

$ordernumber = SystemSetting::getByKey("ARC_STORE_ORDERNUMBER");
if (empty($ordernumber->setting)) {
    $ordernumber->setting = "No order placed";
}
?>

<form>
    <div class="container">
        <h3>Settings</h3>
        <div class="panel panel-default">
            
            <table class="table table-striped">
                <tr><th>Setting</th><th>Value</th></tr>
                <tr><td>Currency Symbol</td><td><input type="text" class="form-control" id="currencySymbol" value="<?php echo $currenySymbol->setting; ?>"></td></tr>
                <tr><td>Currency Display Location</td><td><select class="form-control" id="currencyDisplay">
                            <option value="Left" <?php
                            if ($currenyDisplay->setting == "Left") {
                                echo " selected";
                            }
                            ?>>Left</option>
                            <option value="Right"<?php
                            if ($currenyDisplay->setting == "Right") {
                                echo " selected";
                            }
                            ?>>Right</option>
                        </select></td></tr>
                <tr><td>VAT Percent (%)</td><td><input type="text" class="form-control" id="vat" value="<?php echo $vat->setting; ?>"></td></tr>
                <tr><td>Next Order Number</td><td><?php echo $ordernumber->setting; ?></td></tr>
            </table>

        </div>
        <div class="text-right">
            <button type="button" class="btn btn-success" onclick="ajax.send('POST', {action: 'savesettings', currencySymbol: '#currencySymbol', currencyDisplay: '#currencyDisplay', vat: '#vat'}, '<?php echo arcGetDispatch(); ?>', updateStatus, true);"><span class="fa fa-save"></span> Save</button>
        </div>
    </div>
</form>