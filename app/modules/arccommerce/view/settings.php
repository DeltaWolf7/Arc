<?php
    $paypal = SystemSetting::getByKey("ECOM_PAYPAL");
    if ($paypal->id < 1) {
        $paypal = new SystemSetting();
        $paypal->name = "ECOM_PAYPAL";
        $paypal->update();
    }
?>

<form id="EcomSettings">
    <div class="form-group">
        <label for="paypalid">PayPal ID</label>
        <input type="text" name="paypalid" id="paypayid" value="" placeholder="" class="form-control" />
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>