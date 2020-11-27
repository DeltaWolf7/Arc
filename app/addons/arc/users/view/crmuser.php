<?php
    if (is_numeric(system\Helper::arcGetLastURIItem())) {
        $user = User::getByID(system\Helper::arcGetLastURIItem());
        if ($user->id > 0) {
            $crmuser = CRMUser::getByUserID($user->id);
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
                <label for="company">Company</label>
                <input maxlength="50" type="text" class="form-control" name="company" placeholder="Company"
                    value="<?php echo $crmuser->company; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input maxlength="20" type="text" class="form-control" name="phone" placeholder="Phone"
                    value="<?php echo $crmuser->phone; ?>">
            </div>
            <div class="form-group">
                <label for="source">Source</label>

                <?php echo system\Helper::arcCreateHTMLSelect(["Direct", "Email", "Google", "Phone", "Word of Mouth", "Advert", "Other"], 
                            ["Direct", "Email", "Google", "Phone", "Word", "AD", "Other"], "form-control", $crmuser->source, "source"); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" name="notes" rows="12"><?php echo $crmuser->notes; ?></textarea>
            </div>
        </div>
    </div>

    <div class="text-right">
        <button class="btn btn-success" type="submit">Save</button>
    </div>
</form>

<?php
        }
    }
?>