<div class="text-right mb-2">
    <button onclick="editGroup(0);" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Create
        Group</button>
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Users</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="groupsData">
            
        </tbody>
    </table>
</div>




<div class="modal" id="editGroupModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Group</h5>
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i
                        class="sr-only">Close</i></button>
            </div>
            <form id="groupForm">
                <div class="modal-body">
                    <input type="hidden" id="groupid" name="groupid" value="0" />
                    <div class="form-group">
                        <label for="groupname">Group Name</label>
                        <input maxlength="100" type="text" class="form-control" id="groupname" name="groupname"
                            placeholder="Group name">
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="groupname">Group Description</label>
                            <input maxlength="100" type="text" class="form-control" id="groupdescription"
                                name="groupdescription" placeholder="Group description">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button class="btn btn-success" type="submit"><i class="far fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>