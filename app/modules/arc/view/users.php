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