<?php
    if (is_numeric(system\Helper::arcGetLastURIItem())) {
        $user = User::getByID(system\Helper::arcGetLastURIItem());
        if ($user->id > 0) {
            $crmcontacts = CRMUserContact::getAllByUserID($user->id);
?>

<div class="card mt-3">
    <div class="card-body">
        <h4>Contacts</h4>
        <div class="row">
            <div class="col-md-12 border-top border-primary"></div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12 text-end">
                <form id="crmnewcontact">
                    <input type="hidden" name="contactuserid" value="<?php echo $user->id; ?>" />
                    <input type="hidden" name="contactid" value="0" />
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-plus"></i> Create</button>
                </form>
            </div>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-striped" aria-label="contacts">
                <thead class="text-primary">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Title</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col" style="width: 100px;">Action</th>
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
                        <td class="text-end">
                        
                                <button class="btn btn-primary btn-sm"
                                    onclick="editCRMContact('<?php echo $contact->id; ?>', '<?php echo $user->id; ?>')"><i
                                        class="fa fa-pencil"></i></button>

                                <button class="btn btn-danger btn-sm"
                                    onclick="crmRemoveContact(<?php echo $contact->id; ?>)"><i
                                        class="fa fa-remove"></i></button>
                       
                        </td>
                    </tr>
                    <?php
            }
?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
        }
    }
?>

<div class="modal" id="editContactModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="crmeditcontactform">
                <input type="hidden" name="contactuserid" id="contactuserid" value="<?php echo $user->id; ?>" />
                <input type="hidden" name="contactid" id="contactid" value="0" />
                <div class="modal-body">

                    <label for="contactname" class="form-label">Name</label>
                    <input maxlength="100" type="text" class="form-control" name="contactname" id="contactname"
                        placeholder="Contact Name">

                    <label for="contacttitle" class="form-label">Title</label>
                    <input maxlength="50" type="text" class="form-control" name="contacttitle" id="contacttitle"
                        placeholder="Contact Title">

                    <label for="contactemail" class="form-label">Email</label>
                    <input maxlength="100" type="text" class="form-control" name="contactemail" id="contactemail"
                        placeholder="Contact Email">

                    <label for="contactphone" class="form-label">Phone</label>
                    <input maxlength="20" type="text" class="form-control" name="contactphone" id="contactphone"
                        placeholder="Contact Phone">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button class="btn btn-success" type="submit"><i class="far fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>