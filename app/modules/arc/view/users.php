<div class="card" id="mainPanel">
    <div class="card-body">
        <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
                <li id="tabUsers" role="presentation" class="nav-item"><a href="#users" class="nav-link active" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Users</a></li>
                <li id="tabGroups" role="presentation" class="nav-item"><a href="#groups" class="nav-link" role="tab" data-toggle="tab"><i class="fa fa-group"></i> Groups</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="users"></div>
                <div role="tabpanel" class="tab-pane" id="groups"></div>
            </div>
        </div>
    </div>
</div>

        <div class="modal fade" id="removeUserModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Remove User</h5>
                        <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
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

        <div id="editUserPanel" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit User</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input type="text" class="form-control" id="firstname" placeholder="Firstname">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Lastname</label>
                                <input type="text" class="form-control" id="lastname" placeholder="Lastname">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password (Leave blank to keep unchanged)</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="retype">Retype</label>
                                <input type="password" class="form-control" id="retype" placeholder="Retype" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="enabled">Account Enabled</label>
                                <select id="enabled" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


                            <div class="card">
                                <div class="card-body" id="usrgroups">
                                </div>

                            </div>
                                            
                  <div class="card">
                                <div class="card-body text-right">
                                 <button class="btn btn-secondary" id="closeUserBtn">Close</button>
                        <button class="btn btn-primary" id="saveUserbtn">Save</button>
                                </div>
                            </div>
                       
       
               
        </div>

        <div class="modal fade" id="removeGroupModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Remove Group</h5>
                        <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
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
        <div class="modal fade" id="editGroupModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Edit Group</h5>
                        <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="groupname">Group Name</label>
                            <input maxlength="100" type="text" class="form-control" id="groupname" placeholder="Group name">
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="groupname">Group Description</label>
                                <input maxlength="100" type="text" class="form-control" id="groupdescription" placeholder="Group description">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" id="saveGroupBtn">Save</button>
                    </div>
                </div>
            </div>
        </div>