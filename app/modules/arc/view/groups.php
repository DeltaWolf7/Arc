<div class="card">
    <div class="card-body">
        <div class="text-end mb-2">
            <button onclick="editGroup(0);" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Create
                Group</button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="text-primary">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Users</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody id="groupsData">

                </tbody>
            </table>
        </div>
    </div>
</div>




<div class="modal" id="editGroupModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="groupForm">
                <div class="modal-body">
                    <input type="hidden" id="groupid" name="groupid" value="0" />

                    <label for="groupname" class="form-label">Group Name</label>
                    <input maxlength="100" type="text" class="form-control" id="groupname" name="groupname"
                        placeholder="Group name">

                    <label for="groupname" class="form-label">Group Description</label>
                    <input maxlength="100" type="text" class="form-control" id="groupdescription"
                        name="groupdescription" placeholder="Group description">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal"> Close</button>
                    <button class="btn btn-success" type="submit"><i class="far fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>