<div class="page-header">
    <h1>Permissions</h1>
</div>

<div id="data">
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Permission</h4>
            </div>
            <div class="modal-body" id="edit">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="editButton" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    var groupid;
    
    function editPermission(group, id) {
        groupid = group;
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
                    updateStatus(jdata.status, jdata.data);
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
    
    $(document).ready(function() {
       getData(); 
    });
</script>
