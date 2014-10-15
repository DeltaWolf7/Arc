<div class="page-header">
    <h1>Address</h1>
</div>

<?php
$address = new Address();
if (arcGetURLData("data2") != "0") {
    $address->getByID(arcGetURLData("data2"));
} elseif (arcGetURLData("data3") == "0") {
    echo "No client";
    echo "<script>alert('You can only create addresses for valid clients.');window.location='" . arcGetModulePath() . "/clients/0';</script>";
    exit();
}
?>

<form role="form">
    <div class="form-group">
        <label for="address1">Address 1</label>
        <input maxlength="100" type="text" class="form-control" id="address1" placeholder="Address" value="<?php echo $address->address1; ?>">
    </div>
    <div class="form-group">
        <label for="address2">Address 2</label>
        <input maxlength="100" type="text" class="form-control" id="address2" placeholder="Address" value="<?php echo $address->address2; ?>">
    </div>
    <div class="form-group">
        <label for="address3">Address 3</label>
        <input maxlength="100" type="text" class="form-control" id="address3" placeholder="Address" value="<?php echo $address->address3; ?>">
    </div>
    <div class="form-group">
        <label for="postcode">Post Code</label>
        <input maxlength="10" type="text" class="form-control" id="postcode" placeholder="Post Code" value="<?php echo $address->postcode; ?>">
    </div>
    <div class="form-group">
        <label for="default">Primary Address </label>
        <input type="checkbox" id="default" name="default" <?php if ($address->pri == true) { echo "checked"; } ?>>
    </div>

    <input type="hidden" id="id" value="<?php echo arcGetURLData("data2"); ?>">
    <input type="hidden" id="clientid" value="<?php echo arcGetURLData("data3"); ?>">
    <input type="hidden" id="userid" value="<?php echo $user->id; ?>">

    <p class="text-right">
        <button type="button" class="btn btn-primary" onclick="ajax.send('POST', {action: 'saveaddress', id: '#id', userid: '#userid', address1: '#address1', clientid: '#clientid',
                    address2: '#address2', address3: '#address3', postcode: '#postcode', default:'#default'}, '<?php echo arcGetDispatch(); ?>', updateStatus, true)"><span class="glyphicon glyphicon-floppy-disk"></span> Save Address</button>
        <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo arcGetModulePath(); ?>/clients/<?php echo arcGetURLData("data3"); ?>'"><span class="glyphicon glyphicon glyphicon-remove"></span> Exit To Client</button>
    </p>
</form>