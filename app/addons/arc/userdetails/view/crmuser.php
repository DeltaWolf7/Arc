<?php
     $user = system\Helper::arcGetUser();
     if ($user->id > 0) {
?>

<h4 class="mt-3">CRM Details</h4>
<div class="row mt-3">
    <div class="col-md-12 border-top border-primary"></div>
</div>

<form id="crmuserform">
    <input type="hidden" value="<?php echo $user->id; ?>" name="userid" />
    <input type="hidden" value="<?php echo $crmuser->id; ?>" name="crmuserid" />
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input maxlength="20" type="text" class="form-control" name="phone" placeholder="Phone"
                    value="<?php echo $crmuser->phone; ?>">
            </div>
        </div>
    </div>

    <div class="text-right">
        <button class="btn btn-success" type="submit"><i class="far fa-save"></i> Save</button>
    </div>
</form>

<?php
        }
?>