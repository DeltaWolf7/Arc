<div class="page-header">
    <h1>Question Editor</h1>
</div>

<p  class="text-right">
    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span> New Question Group</button>
</p>

<div id="data">
    
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">New Group</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="group">
                    </div>
                    <div class="form-group">
                        <label>Text</label>
                        <textarea id="text" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="saveGroup();">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Group /-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Group</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="editgroup">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button id="editButton" type="button" class="btn btn-success">Save changes</button>
            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Group</h4>
            </div>
            <div class="modal-body" id="deleteBody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                <button id="deleteButton" type="button" class="btn btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>


<script>
    function updateGroup(data) {
        var data2 = data.split('|');
        if (data2[0] == "success")
        {
            window.location = "<?php echo system\Helper::arcGetModulePath(); ?>";
        }
        updateStatus(data);
    }

    function deleteGroup(id, name) {
        var text = 'Are you sure you want to delete the group \'' + name + '\'?';
        var link = "window.location = '<?php echo system\Helper::arcGetModulePath() . "deletegroup/"; ?>" + id + "'";
        $('#deleteButton').attr("onclick", link);
        $('#deleteBody').html(text);
        $('#deleteModal').modal('show');
    }

    function editGroup(id, name) {
        var link = "ajax.send('POST', {action: 'editgroup', name: '#editgroup', id: '" + id + "'}, '<?php system\Helper::arcGetDispatch() ?>', updateGroup, true)";
        $('#editButton').attr("onclick", link);
        $('#editgroup').val(name);
        $('#editModal').modal('show');
    }
    
    function saveGroup() {
         $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "savegroup", group: $("#group").val(), text: $("#text").val()},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
                $("#myModal").modal("hide");
                getData();
            }
        });
    }
    
    function getData() {
     $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getgroups"},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#data").html(jdata.html);
            }
        });
    }
    
    function getQuestions(id) {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "getquestions", id: id},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                $("#data").html(jdata.html);
            }
        });
    }
    
    $(document).ready(function () {
        getData();
    });
</script>