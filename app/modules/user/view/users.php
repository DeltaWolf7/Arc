<div role="tabpanel">
    <ul class="nav nav-tabs" role="tablist">
        <li id="tabUsers" role="presentation"><a onclick="get('users');"><i class="fa fa-user"></i> Users</a></li>
        <li id="tabGroups" role="presentation"><a onclick="get('groups');"><i class="fa fa-group"></i> Groups</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active table-responsive" id="data">
        </div>
    </div>
</div>

<div id="status"></div>

<div class="modal fade" id="removeUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Remove User</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to permanently remove this user?
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">No</a>
                <a class="btn btn-primary" id="removeUserBtn">Yes</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Edit User</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
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
                                    <input type="text" class="form-control" id="email" placeholder="Email" disabled="true">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="retype">Retype</label>
                                    <input type="password" class="form-control" id="retype" placeholder="Retype" autocomplete="off">
                                </div>
                                <div class="form-group text-right">
                                    <div class="checkbox">
                                        <label><input type="checkbox" id="enabled" /> Account Enabled</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Group Membership</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="groups">Groups</label>
                                            <select id="groups" class="form-control" size="16">
                                                <?php
                                                $groups = UserGroup::getAllGroups();
                                                foreach ($groups as $group) {
                                                    echo "<option value=\"{$group->name}\">{$group->name}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="grp2">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a class="btn btn-default btn-block" id="addGroupBtn"><i class="fa fa-plus"></i> Add to group</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a class="btn btn-default btn-block" id="removeFromGroupBtn"><i class="fa fa-remove"></i> Remove from group</a> 
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss="modal">Close</a>
                    <a class="btn btn-primary" id="saveUserbtn">Save</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="removeGroupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Remove Group</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to permanently remove this group?</p>
                <small>Built in system groups 'Administrators', 'Users' and 'Guests' cannot be removed.</small>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">No</a>
                <a class="btn btn-primary" id="removeGroupDoBtn">Yes</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Edit Group</h4>
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
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="saveGroupBtn">Save</a>
            </div>
        </div>
    </div>
</div>