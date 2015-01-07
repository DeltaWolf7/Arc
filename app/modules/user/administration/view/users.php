<div class="page-header">
    <h1>User Management</h1>
</div>

<div role="tabpanel">

    <ul class="nav nav-tabs" role="tablist">
        <li id="tabUsers" role="presentation"><a onclick="get('users');"><i class="fa fa-users"></i> Users</a></li>
        <li id="tabGroups" role="presentation"><a onclick="get('groups');"><i class="fa fa-group"></i> Groups</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="data">
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
                            <div class="panel-heading">
                                <h3 class="panel-title">User Details</h3>
                            </div>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">User Group</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="groups">Groups</label>
                                            <select id="groups" class="form-control" size="10">
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
                                <div class="text-right">
                                    <a class="btn btn-default" id="addGroupBtn"><i class="fa fa-plus"></i> Add to group</a> <a class="btn btn-default" id="removeFromGroupBtn"><i class="fa fa-remove"></i> Remove from group</a> 
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">IP Addresses</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <ul class="list-unstyled">

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div></div>

            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="saveUserbtn">Save</a>
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
                <form role="form">
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
                </form>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="saveGroupBtn">Save</a>
            </div>
        </div>
    </div>
</div>

<script>
    var userid;
    var groupid;

    function get(action) {
        if (action == "users") {
            $("#tabUsers").attr("class", "active");
            $("#tabGroups").removeClass("active");
        } else {
            $("#tabUsers").removeClass("active");
            $("#tabGroups").attr("class", "active");
        }
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: action},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $('#data').html(jdata.html);
            }
        });
    }

    $("#addGroupBtn").click(function () {
        if ($('#groups').val() != null) {
            $.ajax({
                url: "<?php system\Helper::arcGetDispatch(); ?>",
                dataType: "json",
                type: "post",
                contentType: "application/x-www-form-urlencoded",
                data: {action: "addgroup", id: userid, group: $('#groups').val()},
                success: function (data) {
                    var jdata = jQuery.parseJSON(JSON.stringify(data));
                    updateStatus(jdata.status, jdata.data);
                },
                complete: function () {
                    editUser(userid);
                }
            });
        }
    });

    $("#removeFromGroupBtn").click(function () {
        if ($('#groups2').val() != null) {
            $.ajax({
                url: "<?php system\Helper::arcGetDispatch(); ?>",
                dataType: "json",
                type: "post",
                contentType: "application/x-www-form-urlencoded",
                data: {action: "removefromgroup", id: userid, group: $('#groups2').val()},
                success: function (data) {
                    var jdata = jQuery.parseJSON(JSON.stringify(data));
                    updateStatus(jdata.status, jdata.data);
                },
                complete: function () {
                    editUser(userid);
                }
            });
        }
    });


    function editUser(id) {
        userid = id;
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "user", id: userid},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $('#firstname').val(jdata.firstname);
                $('#lastname').val(jdata.lastname);
                $('#email').val(jdata.email);
                $('#grp2').html(jdata.group);
            },
            complete: function () {
                $("#editUserModal").modal("show");
            }
        });
    }

    function removeUser(id) {
        userid = id;
        $("#removeUserModal").modal("show");
    }

    $("#removeUserBtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {id: userid, action: "remove"},
            complete: function () {
                get("users");
                $("#removeUserModal").modal("hide");
            }
        });
    });

    $("#saveUserbtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "saveuser", id: userid, firstname: $('#firstname').val(),
                lastname: $('#lastname').val(), email: $('#email').val(),
                password: $('#password').val(), retype: $('#retype').val()},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
                if (jdata.status == "success") {
                    $("#editUserModal").modal("hide");
                }
            },
            complete: function () {
                get("users");
            }
        });
    });

    function editGroup(id) {
        groupid = id;
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "group", id: groupid},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $('#groupname').val(jdata.name);
                $('#groupdescription').val(jdata.description);
            },
            complete: function () {
                $("#editGroupModal").modal("show");
            }
        });
    }

    function removeGroup(id) {
        groupid = id;
        $("#removeGroupModal").modal("show");
    }

    $("#removeGroupDoBtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {id: groupid, action: "removegroup"},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
            },
            complete: function () {
                get("groups");
                $("#removeGroupModal").modal("hide");
            }
        });
    });

    $("#saveGroupBtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "savegroup", id: groupid, name: $('#groupname').val(),
                description: $('#groupdescription').val()},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
                if (jdata.status == "success") {
                    $("#editGroupModal").modal("hide");
                }
            },
            complete: function () {
                get("groups");
            }
        });
    });

    $(document).ready(function () {
        get("users");
    });
</script>