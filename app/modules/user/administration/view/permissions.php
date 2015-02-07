<div class="page-header">
    <h1>Permissions</h1>
</div>

<div id="data" class="table-responsive">
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i aria-hidden="true">&times;</i><i class="sr-only">Close</i></button>
                <h4 class="modal-title" id="myModalLabel">Edit Permission</h4>
            </div>
            <div class="modal-body" id="edit">

            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="savePermissionsBtn">Save</a>
            </div>
        </div>
    </div>
</div>

<script>
    var groupid;
    var pid;

    $("#savePermissionsBtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "savepermission", id: pid, group: groupid, module: $("#module").val()},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus("status");
                if (jdata.status == "success") {
                    $("#editModal").modal("hide");
                    getData();
                }
            }
        });
    });

    function editPermission(group, id) {
        groupid = group;
        pid = id;
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "editpermission", id: id},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#edit").html(jdata.data);
                $("#editModal").modal("show");
            }
        });
    }

    function deletePermission(id) {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "deletepermission", id: id},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                if (jdata.status == "success") {
                    updateStatus("status");
                    getData();
                }
            }
        });
    }

    function getData() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getdata"},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#data").html(jdata.data);
            }
        });
    }

    $(document).ready(function () {
        getData();
    });
</script>
