<?php
$user = system\Helper::arcGetUser();
$profileImage = $user->getProfileImage();
$crmuser = CRMuser::getByUserID($user->id);
if ($crmuser->id == 0){
    $crmuser = new CRMUser();
}

$image = "No image";
if (!empty($profileImage)) {
    $image = "<img class=\"img-fluid\" src=\"" . $profileImage . "\" />";
}
?>
<form id="detailsForm">
    <div class="row">
        <div class="col-md-6">
            <div class="card mt-2">
                <div class="card-body">
                    <h4 class="card-title">Personal</h4>
                    <div class="form-group">
                        <label for="firstname">First name</label>
                        <input type="firstname" class="form-control" name="firstname" maxlength="50"
                            placeholder="First name" value="<?php echo $user->firstname; ?>">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last name</label>
                        <input type="lastname" class="form-control" name="lastname" maxlength="50"
                            placeholder="Last name" value="<?php echo $user->lastname; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" maxlength="100" placeholder="Email"
                            value="<?php echo $user->email; ?>" disabled="true">
                    </div>
                    <div class="form-group">
                        <label for="password">Password (Leave blank to keep same)</label>
                        <input type="password" class="form-control" name="password" maxlength="100"
                            placeholder="Password" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="retype">Retype</label>
                        <input type="password" class="form-control" name="password2" maxlength="100"
                            placeholder="Retype" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <?php echo $image; ?>
                        </div>
                        <div class="col-md-8">
                            <button id="uploadImage" class="btn btn-primary btn-block btn-file mt-5"><input
                                    type="file">Change
                                Image</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-2 mb-5 pb-5">
                <div class="card-body">
                    <h4 class="card-title">Contacts</h4>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input maxlength="20" type="text" class="form-control" name="phone" placeholder="phone"
                            value="<?php echo $crmuser->phone; ?>">
                    </div>
                </div>
            </div>
            <div class="text-right mt-5 pt-5">
                <button id="saveDetailsBtn" class="btn btn-primary btn-block mt-3">Update</button>
            </div>
        </div>
    </div>
</form>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Addreses</h4>
                <table class="table table-striped">
                    <tr>
                        <th>Address Lines</th>
                        <th>County</th>
                        <th>Postcode</th>
                        <th>Country</th>
                        <th>Billing</th>
                        <th>Delivery</th>
                        <th><button class="btn btn-success btn-sm" onclick="editAddress(0)"><i
                                    class="fas fa-plus-square"></i> Add</button></th>
                    </tr>
                    <?php
                            $crmaddresses = CRMUserAddress::getAllByUserID($user->id);
                            foreach ($crmaddresses as $address) {
                        ?>
                    <tr>
                        <td><?php echo $address->addresslines; ?></td>
                        <td><?php echo $address->county; ?></td>
                        <td><?php echo $address->postcode; ?></td>
                        <td><?php echo $address->country; ?></td>
                        <td><?php if ($address->isbilling == 1) { echo "Yes"; } else { echo "No"; } ?></td>
                        <td><?php if ($address->isdelivery == 1) { echo "Yes"; } else { echo "No"; } ?></td>
                        <td><button class="btn btn-primary btn-sm" onclick="editAddress(<?php echo $address->id; ?>)"><i
                                    class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm"
                                onclick="deleteAddress(<?php echo $address->id; ?>)"><i
                                    class="fas fa-times"></i></button>
                        </td>
                    </tr>
                    <?php
                            }
                        ?>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="editAddressModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Adress Editor</h5>
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i
                        class="sr-only">Close</i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="addresslines">Address Lines</label>
                    <textarea rows="5" class="form-control" id="addresslines"></textarea>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="county">County</label>
                        <input maxlength="50" type="text" class="form-control" id="county" placeholder="County">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="postcode">Postcode</label>
                        <input maxlength="10" type="text" class="form-control" id="postcode" placeholder="Postcode">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <?php echo system\Helper::arcCreateHTMLSelect(ArcCountries::getArray(), ArcCountries::getArray(), "form-control", null, "country"); ?>
                    </div>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="isbilling">
                    <label class="form-check-label" for="isbilling">Billing?</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="isdelivery">
                    <label class="form-check-label" for="isdelivery">Delivery?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Close</button>
                <button class="btn btn-success" onclick="saveAddress()">Save</button>
            </div>
        </div>
    </div>
</div>