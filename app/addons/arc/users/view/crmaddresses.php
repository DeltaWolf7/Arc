<?php
    if (is_numeric(system\Helper::arcGetLastURIItem())) {
        $user = User::getByID(system\Helper::arcGetLastURIItem());
        if ($user->id > 0) {
?>
<div class="card mt-3">
    <div class="card-body">
        <h4>Addresses</h4>
        <div class="row">
            <div class="col-md-12 border-top border-primary">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
            </div>
            <div class="col-md-6 text-end">
                <form id="crmnewaddress">
                    <input type="hidden" name="addressid" value="0" />
                    <input type="hidden" name="addressuserid" value="0" />
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-plus"></i> Create</button>
                </form>
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-striped" aria-label="Addresses">
                <thead class="text-primary">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Address Lines</th>
                        <th scope="col">County</th>
                        <th scope="col">Postcode</th>
                        <th scope="col">Country</th>
                        <th scope="col">Billing</th>
                        <th scope="col">Delivery</th>
                        <th scope="col" style="width: 100px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
            $crmaddresses = CRMUserAddress::getAllByUserID($user->id);
            foreach ($crmaddresses as $address) {
                $del = "No";
                if ($address->isdelivery == 1) {
                    $del = "Yes";
                }
                $bil = "No";
                if ($address->isbilling == 1) {
                    $bil = "Yes";
                }
            ?>
                    <tr>
                        <td><?php echo $address->id; ?></td>
                        <td><?php echo $address->addresslines; ?></td>
                        <td><?php echo $address->county; ?></td>
                        <td><?php echo $address->postcode; ?></td>
                        <td><?php echo $address->country; ?></td>
                        <td><?php echo $bil; ?></td>
                        <td><?php echo $del; ?></td>
                        <td class="text-end">
                    
                                <button class="btn btn-primary btn-sm"
                                    onclick="editCRMAddress('<?php echo $address->id; ?>', '<?php echo $address->userid; ?>')"><i
                                        class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger btn-sm"
                                    onclick="crmRemoveAddress('<?php echo $address->id; ?>')"><i
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

<form id="crmeditaddressform">
<div class="modal" tabindex="-1" id="editAddressModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Address Editor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <input type="hidden" name="addressuserid" id="addressuserid" value="<?php echo $user->id; ?>" />
                <input type="hidden" name="addressid" id="addressid" value="0" />
                <div class="modal-body">

                    <label for="addresslines" class="form-label">Address Lines</label>
                    <textarea rows="5" class="form-control" id="addresslines" name="addresslines"></textarea>


                    <label for="county" class="form-label">County</label>
                    <input maxlength="50" type="text" class="form-control" id="county" name="county"
                        placeholder="County">

                    <label for="postcode" class="form-label">Postcode</label>
                    <input maxlength="10" type="text" class="form-control" id="postcode" name="postcode"
                        placeholder="Postcode">


                    <label for="country" class="form-label">Country</label>
                    <?php echo system\Helper::arcCreateHTMLSelect(ArcCountries::getArray(), ArcCountries::getArray(), "form-control", "United Kingdom", "country"); ?>

                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="isbilling" name="isbilling">
                        <label class="form-check-label" for="isbilling">Billing?</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="isdelivery" name="isdelivery">
                        <label class="form-check-label" for="isdelivery">Delivery?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button class="btn btn-success" type="submit"><i class="far fa-save"></i> Save</button>
                </div>
        </div>
    </div>
</div>
</form>