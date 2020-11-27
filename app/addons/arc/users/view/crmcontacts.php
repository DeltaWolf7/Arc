<?php
    if (is_numeric(system\Helper::arcGetLastURIItem())) {
        $user = User::getByID(system\Helper::arcGetLastURIItem());
        if ($user->id > 0) {
            $crmcontacts = CRMUserContact::getAllByUserID($user->id);
?>

<h4 class="mt-3">Contacts</h4>
<div class="row">
    <div class="col-md-12 border-top border-primary"></div>
</div>

<div class="row mt-2">
    <div class="col-md-12 text-right">
        <form id="crmnewcontact">
            <input type="hidden" name="contactuserid" value="<?php echo $user->id; ?>" />
            <input type="hidden" name="contactid" value="0" />
            <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-plus"></i> Create</button>
        </form>
    </div>
</div>

<div class="table-responsive mt-3">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Title</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $crmcontacts = CRMUserContact::getAllByUserID($user->id);
            foreach ($crmcontacts as $contact) {
?>
            <tr>
                <td><?php echo $contact->id; ?></td>
                <td><?php echo $contact->name; ?></td>
                <td><?php echo $contact->title; ?></td>
                <td><?php echo $contact->email; ?></td>
                <td><?php echo $contact->phone; ?></td>
                <td style="width: 10px;">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary btn-sm"
                            onclick="editCRMContact('<?php echo $contact->id; ?>', '<?php echo $user->id; ?>')"><i
                                class="fa fa-pencil"></i></button>

                        <button style="width: 35px;" class="btn btn-danger btn-sm"
                            onclick="crmRemoveContact(<?php echo $contact->id; ?>)"><i
                                class="fa fa-remove"></i></button>
                    </div>
                </td>
            </tr>
            <?php
            }
?>

        </tbody>
    </table>
</div>

<?php
        }
    }
?>

<div class="modal" id="editContactModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Contact</h5>
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i
                        class="sr-only">Close</i></button>
            </div>
            <form id="crmeditcontactform">
                <input type="hidden" name="contactuserid" id="contactuserid" value="<?php echo $user->id; ?>" />
                <input type="hidden" name="contactid" id="contactid" value="0" />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="contactname">Name</label>
                        <input maxlength="100" type="text" class="form-control" name="contactname" id="contactname"
                            placeholder="Contact Name">
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="contacttitle">Title</label>
                            <input maxlength="50" type="text" class="form-control" name="contacttitle" id="contacttitle"
                                placeholder="Contact Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="contactemail">Email</label>
                            <input maxlength="100" type="text" class="form-control" name="contactemail"
                                id="contactemail" placeholder="Contact Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="contactphone">Phone</label>
                            <input maxlength="20" type="text" class="form-control" name="contactphone" id="contactphone"
                                placeholder="Contact Phone">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>