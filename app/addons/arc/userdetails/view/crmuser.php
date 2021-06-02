<?php
     $user = system\Helper::arcGetUser();
     if ($user->id > 0) {
        $crmuser = CRMUser::getByUserID($user->id);
?>

<div class="card mt-3">
    <div class="card-body">
        <h4>CRM Details</h4>
        <div class="row mt-3">
            <div class="col-md-12 border-top border-primary"></div>
        </div>

        <form id="crmuserform">
            <input type="hidden" value="<?php echo $user->id; ?>" name="userid" />
            <input type="hidden" value="<?php echo $crmuser->id; ?>" name="crmuserid" />
            <div class="row mt-3">
                <div class="col-md-6">

                        <label for="phone" class="form-label">Phone</label>
                        <input maxlength="20" type="text" class="form-control" name="phone" placeholder="Phone"
                            value="<?php echo $crmuser->phone; ?>">
                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-success" type="submit"><i class="far fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</div>

<?php
        }
?>