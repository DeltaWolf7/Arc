<div role="tabpanel" id="mainPanel">
    <ul class="nav nav-tabs" role="tablist">
        <li id="tabUsers" role="presentation"><a onclick="get('users');"><i class="fa fa-user"></i> Users</a></li>
        <li id="tabGroups" role="presentation"><a onclick="get('groups');"><i class="fa fa-group"></i> Groups</a></li>
        <li id="tabCompanies" role="presentation"><a onclick="get('companies');"><i class="fa fa-building"></i> Companies</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active table-responsive" id="data">
        </div>
    </div>
</div>

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


<div class="panel panel-default" id="editUserPanel" style="display: none;">
    <div class="panel-heading">
        <h4 class="panel-title">Edit User</h4>
    </div>
    <div class="panel-body">
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
                    <input type="checkbox" id="enabled" /><label for="enabled">Account Enabled</label>
                </div>

            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label for="groups">Groups</label>
                    <select id="groups" class="form-control">
                        <?php
                        $groups = UserGroup::getAllGroups();
                        foreach ($groups as $group) {
                            echo "<option value=\"{$group->name}\">{$group->name}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <a class="btn btn-default btn-block" id="addGroupBtn"><i class="fa fa-plus"></i> Add</a>
                </div>


                <div class="form-group">
                    <label for="grps">Group Membership</label>
                    <ul id="grps" class="list-group">

                    </ul>
                </div>

                <div class="form-group">
                    <label for="companies">Companies</label>
                    <select id="companies" class="form-control">
                        <?php
                        $companies = Company::getAll();
                        foreach ($companies as $company) {
                            echo "<option value=\"{$company->id}\">{$company->name}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <a class="btn btn-default btn-block" id="addCompanyBtn"><i class="fa fa-plus"></i> Add</a>
                </div>


                <div class="form-group">
                    <label for="compgrps">Company Association(s)</label>
                    <ul id="compgrps" class="list-group">

                    </ul>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <a class="btn btn-default" id="closeUserBtn">Close</a>
            <a class="btn btn-primary" id="saveUserbtn">Save</a>
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

<div class="modal fade" id="removeCompanyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Remove Company</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to permanently remove this company?</p>
                <small>You cannot remove companies with associated users.</small>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">No</a>
                <a class="btn btn-primary" id="removeCompanyDoBtn">Yes</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editCompanyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Edit Company</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="companyname">Company Name</label>
                    <input maxlength="100" type="text" class="form-control" id="companyname" placeholder="Company name">
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="saveCompanyBtn">Save</a>
            </div>
        </div>
    </div>
</div>