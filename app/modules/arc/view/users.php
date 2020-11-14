<div class="card">
    <div class="card-body table-responsive" id="dataTable">

    </div>
</div>

<div class="modal" id="removeUserModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Remove User</h5>
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i
                        class="sr-only">Close</i></button>
            </div>
            <div class="modal-body">
                Are you sure you want to permanently remove this user?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">No</button>
                <button class="btn btn-primary" id="removeUserBtn">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="removeGroupModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Remove Group</h5>
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i
                        class="sr-only">Close</i></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to permanently remove this group?</p>
                <small>Built in system groups 'Administrators', 'Users' and 'Guests' cannot be removed.</small>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">No</button>
                <button class="btn btn-primary" id="removeGroupDoBtn">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="editGroupModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Group</h5>
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i
                        class="sr-only">Close</i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="groupname">Group Name</label>
                    <input maxlength="100" type="text" class="form-control" id="groupname" placeholder="Group name">
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="groupname">Group Description</label>
                        <input maxlength="100" type="text" class="form-control" id="groupdescription"
                            placeholder="Group description">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Close</button>
                <button class="btn btn-success" id="saveGroupBtn">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="editContactModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Contact</h5>
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i
                        class="sr-only">Close</i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="contactname">Name</label>
                    <input maxlength="100" type="text" class="form-control" id="contactname" placeholder="Contact Name">
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="contacttitle">Title</label>
                        <input maxlength="50" type="text" class="form-control" id="contacttitle"
                            placeholder="Contact Title">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="contactemail">Email</label>
                        <input maxlength="100" type="text" class="form-control" id="contactemail"
                            placeholder="Contact Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="contactphone">Phone</label>
                        <input maxlength="20" type="text" class="form-control" id="contactphone"
                            placeholder="Contact Phone">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Close</button>
                <button class="btn btn-success" id="saveContactBtn">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="editLinkModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Link</h5>
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i
                        class="sr-only">Close</i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input id="linkSearch" type="text" class="form-control" placeholder="Search.."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="searchLink()"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="linksearchresults">

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Close</button>
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